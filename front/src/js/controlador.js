function obtenerImagenes() {
    axios({
        method: 'GET',
        url: 'http://localhost/pruebavue/backend/index.php',
        responseType: 'json'
    }).then(res => {
        console.log(res);
    }).catch(error => {
        console.error(error);
    });
}

obtenerImagenes();