// import axios from "axios";
//
// export function register(credentials){
//     return new Promise((res,rej)=>{
//         axios.post('/register', credentials)
//             .then(response => {
//                 res(response.data);
//             })
//             .catch(err => {
//                 rej(err)
//             })
//     })
// }
//
// export function login(credentials){
//     return new Promise((res,rej)=>{
//
//         axios.post('/login', credentials)
//             .then(response => {
//                 res(response.data);
//             })
//             .catch(err => {
//                 rej(err)
//             })
//     })
// }


// export function getUserToken(){
//     const userToken = localStorage.getItem('user');
//     if(!userToken){
//         return null
//     }
//
//     return JSON.parse(userToken);
// }
