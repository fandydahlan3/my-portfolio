import {useState, useEffect} from 'react';
import { ambilProyek,ambilSkill } from '../api/adminApi';

export function useAdminLogic(){
    const [listKarya, setListKarya] = useState([]);
    const [listSkill, setListSkill] = useState([]);
    const [sedangMuat, setSedangMuat] = useState(false);

    //Fungsi tarik data terbaru dari Server
    const sinkronisasiData  = async () => {
        setSedangMuat(true);
        try {
            const [resProyek, resSkill] = await Promise.all([
                ambilProyek(),
                ambilSkill()
            ]);
            setListKarya(resProyek.data);
            setListSkill(resSkill.data);
        } catch (galat) {
            console.error("Gagal tarik data terbaru:", galat);
        } finally {
            setSedangMuat(false);
        }
    };

    // Jalan kan fungsi pertama kali halaman di buka
    useEffect(() => {
        sinkronisasiData();
    }, []);

    return{
        listKarya,
        listSkill,
        sedangMuat,
        sinkronisasiData
    };
}