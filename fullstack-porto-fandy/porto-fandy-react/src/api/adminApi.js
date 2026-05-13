import axios from "axios";

const base_url_api = 'http://localhost:5000/api';
const dapatkanHeader = ()  =>{
    const tokenLokal = localStorage.getItem('token')
    return { headers: {Authorization: tokenLokal}};
};

// -- DAFTAR PERINTAH KE SERVER ---

// Fungsi Login
export const KirirmLogin = (sandi) => {
    return axios.post(`${base_url_api}/Login`, {password: sandi});
};

//Fungsi get data proyek & skill
export const ambilProyek = () => axios.get(`${base_url_api}/projects`);
export const ambilSkill = () => axios.get(`${base_url_api}/skills`);

//Fungsi Simpan (Tambah/Edit)
export const simpanProyek = (data, id) => {
    if (id) {
        return axios.put(`${base_url_api}/projects/${id}`, data, dapatkanHeader());
    }
    return axios.post(`${base_url_api}/projects`, data, dapatkanHeader());
};

//Fungsi hapus

export const hapusProyek = async(id) => {
        const token = localStorage.getItem('token');
        return await axios.delete (`${base_url_api}/projects/${id}`, {headers: { Authorization:token}});
    };

export const hapusSkill = async(id) => {
        const token = localStorage.getItem('token');
        return await axios.delete (`${base_url_api}/skills/${id}`, {headers: { Authorization:token}});
    };