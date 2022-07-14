// Paginación con DataTable.
var tabla = document.querySelector("#tabla");
var dataTable = new DataTable(tabla,{
    perPage:4,
    perPageSelect:[4,8,12],
// Para cambiar el lenguaje a español.  
    labels: {
    placeholder: "Buscar...",
    perPage: "{select} ",
    noRows: "",
    info: " {start} - {end} de {rows} ",
    }
});

/*
    placeholder: "Buscar:",
    perPage: "{select} Registros por pagina",
    noRows: "Registro no Encontrado",
    info: "Mostrando registros del {start} al {end} de {rows} Registros",
*/