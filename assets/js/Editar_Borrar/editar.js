'use strict'

document.addEventListener('DOMContentLoaded', (e)=>{
    const botonEdit = document.querySelector('#editarAlumno');
    const botonHidden = document.querySelector('#editAlumno');

    botonEdit.addEventListener('click', (e)=>{
        const validarid = botonHidden.value;
        console.log(validarid);
    })
});