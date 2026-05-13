import pandas as pd
import mysql.connector
import json
import os
import sys
from sklearn.cluster import KMeans
from dotenv import load_dotenv

load_dotenv()

def proses_spk():
    db = None
    try:
        # BACA ARGUMEN BULAN & TAHUN DARI NODE.JS
        filter_bulan = int(sys.argv[1]) if len(sys.argv) > 1 else 5
        filter_tahun = int(sys.argv[2]) if len(sys.argv) > 2 else 2026

        db = mysql.connector.connect(
            host=os.getenv("DB_HOST", "localhost"),
            user=os.getenv("DB_USER", "root"),
            password=os.getenv("DB_PASS", ""),
            database=os.getenv("DB_NAME", "spk_climbing")
        )

        kriteria_cols = [f'c{i}' for i in range(1, 11)]
        
        # FILTER DATA ATLET BERDASARKAN PERIODE SECARA KETAT
        query_atlet = "SELECT * FROM atlet WHERE bulan = %s AND tahun = %s"
        tb_atlet = pd.read_sql(query_atlet, db, params=(filter_bulan, filter_tahun))
        
        tb_kriteria = pd.read_sql("SELECT * FROM kriteria", db)

        # Proteksi Jika Data Kosong
        if len(tb_atlet) == 0:
            print(json.dumps([]))
            return

        # =======================================================================
        # PERBAIKAN AKURASI TOTAL: VALIDASI LABEL K-MEANS BERDASARKAN NILAI C1
        # =======================================================================
        if len(tb_atlet) < 2:
            tb_atlet['cluster'] = 0 
            tb_atlet['kategori'] = "Speed Specialist"
        else:
            X = tb_atlet[kriteria_cols].fillna(0)
            model_kmeans = KMeans(n_clusters=2, n_init='auto', random_state=42)
            tb_atlet['cluster'] = model_kmeans.fit_predict(X)
            
            # Cari nilai rata-rata C1 (Kecepatan) pada masing-masing klaster bentukan K-Means
            mean_c1_cluster_0 = tb_atlet[tb_atlet['cluster'] == 0]['c1'].fillna(0).mean()
            mean_c1_cluster_1 = tb_atlet[tb_atlet['cluster'] == 1]['c1'].fillna(0).mean()
            
            # Validasi dinamis: Klaster dengan rata-rata C1 lebih besar WAJIB menjadi Speed Specialist (Cluster 0)
            if mean_c1_cluster_0 >= mean_c1_cluster_1:
                tb_atlet['kategori'] = tb_atlet['cluster'].map({0: "Speed Specialist", 1: "Lead Specialist"})
            else:
                # Jika K-Means meletakkan data speed di klaster 1, kita balik petanya secara aman
                tb_atlet['kategori'] = tb_atlet['cluster'].map({1: "Speed Specialist", 0: "Lead Specialist"})
                tb_atlet['cluster'] = tb_atlet['cluster'].map({0: 1, 1: 0})

        # AMBIL BOBOT DAN BERSIHKAN KEY kriteria
        bobot_speed_raw = {str(k).lower().strip(): float(v) for k, v in tb_kriteria.set_index('id')['bobot_speed'].to_dict().items()}
        bobot_lead_raw = {str(k).lower().strip(): float(v) for k, v in tb_kriteria.set_index('id')['bobot_lead'].to_dict().items()}

        sum_speed = sum(bobot_speed_raw.values()) if sum(bobot_speed_raw.values()) > 0 else 1
        sum_lead = sum(bobot_lead_raw.values()) if sum(bobot_lead_raw.values()) > 0 else 1

        bobot_speed = {k: v / sum_speed for k, v in bobot_speed_raw.items()}
        bobot_lead = {k: v / sum_lead for k, v in bobot_lead_raw.items()}

        # PROSES NORMALISASI MATRIKS SAW (BENEFIT)
        tb_norm = tb_atlet[kriteria_cols].copy().astype(float)
        max_vals = tb_atlet[kriteria_cols].max()

        for col in kriteria_cols:
            if max_vals[col] == 0:
                tb_norm[col] = 0
            else:
                tb_norm[col] = tb_atlet[col] / max_vals[col]
        
        tb_norm = tb_norm.fillna(0)

        # HITUNG SKOR TOTAL SAW
        def hitung_skor(row):
            idx = row.name
            weights = bobot_speed if row['cluster'] == 0 else bobot_lead
            total_skor = 0
            for col in kriteria_cols:
                key_kolom = col.lower().strip()
                val_norm = tb_norm.loc[idx, col]
                weight_val = weights.get(key_kolom, 0)
                total_skor += val_norm * weight_val
            return round(total_skor, 4)

        tb_atlet['skor_saw'] = tb_atlet.apply(hitung_skor, axis=1)

        # PROSES SORTING PERANKINGAN PER CLUSTER
        tb_atlet['ranking_nasional'] = 0
        for cluster_id in [0, 1]:
            mask = tb_atlet['cluster'] == cluster_id
            if mask.any():
                sorted_indices = tb_atlet[mask].sort_values(by='skor_saw', ascending=False).index
                for rank, idx in enumerate(sorted_indices, start=1):
                    tb_atlet.loc[idx, 'ranking_nasional'] = rank

        # UPDATE KE DATABASE MYSQL
        cursor = db.cursor()
        for _, row in tb_atlet.iterrows():
            sql_update = "UPDATE atlet SET cluster = %s, skor_saw = %s, ranking_nasional = %s WHERE id = %s"
            cursor.execute(sql_update, (int(row['cluster']), float(row['skor_saw']), int(row['ranking_nasional']), int(row['id'])))
        db.commit()
        cursor.close()

        # FORMAT JSON OUTPUT SECARA UTUH BESERTA K-MENTAH KAPITAL
        tb_atlet_sorted = tb_atlet.sort_values(by=['cluster', 'ranking_nasional'])
        hasil = []
        for _, row in tb_atlet_sorted.iterrows():
            hasil.append({
                'id': int(row['id']), 'nama_atlet': str(row['nama_atlet']), 'kategori': str(row['kategori']),
                'skor_saw': float(row['skor_saw']), 'ranking_nasional': int(row['ranking_nasional']),
                'cluster': int(row['cluster']), 'bulan': int(row['bulan']), 'tahun': int(row['tahun']),
                'C1': float(row['c1']), 'C2': float(row['c2']), 'C3': float(row['c3']), 'C4': float(row['c4']),
                'C5': float(row['c5']), 'C6': float(row['c6']), 'C7': float(row['c7']), 'C8': float(row['c8']),
                'C9': float(row['c9']), 'C10': float(row['c10'])
            })

        print(json.dumps(hasil))

    except Exception as e:
        print(json.dumps({"error": f"Python error: {str(e)}"}))
    finally:
        if db is not None and db.is_connected():
            db.close()

if __name__ == "__main__":
    proses_spk()
