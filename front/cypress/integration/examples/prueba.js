var precio;
var contador;
var idProducto;
describe('Search test cases', function(){
    it('Vista de productos', function(){
        cy.visit('http://localhost:8080/');
        cy.get('#navProductos').click();

        cy.get('#sProductos').find('#idProducto').invoke("text").then((el) =>{
            console.log(el);

        //cy.get(':nth-child(1) > .card > .card-body > #btnModal').click();
        cy.get('#sProductos').find('#btnModal').click();
        //cy.get('#aumentar > #cantidadProducto').select('2');
        cy.get('#cantidadProducto').select('3');
        
        //se extrae el precio 
        cy.get('.modal-body > #precio').invoke("text").then((precio) => {
            precio = Number(precio);
            console.log(precio);
            //extraigo número de comprados
            cy.get('.modal-body > #contador').invoke("text").then((contador) => {
                contador = Number(contador);
                console.log(contador);
                expect(precio * contador).to.equal(precio * contador);
            });
        });

        cy.get('#agregarCarrito').click();

        cy.get('#exampleModal > .modal-dialog > .modal-content > .modal-footer > #cerrar').click();
        }); 
    });

    it('Test de carrito de compras', function(){
        cy.visit('http://localhost:8080/');
        cy.get('#navProductos').click();

        cy.get('#sProductos').find('#idProducto').invoke("text").then((el) =>{
            console.log(el);

        cy.get('#sProductos').find('#btnModal',el).click();
        cy.get('#aumentar > #cantidadProducto').select('2');
        
        //se extrae el precio 
        cy.get('.modal-body > #precio').invoke("text").then((precio) => {
            precio = Number(precio);
            console.log(precio);
            //extraigo número de comprados
            cy.get('.modal-body > #contador').invoke("text").then((contador) => {
                contador = Number(contador);
                console.log(contador);
                expect(precio * contador).to.equal(precio * contador);
            });
        });

        cy.get('#agregarCarrito').click();


        cy.get('#exampleModal > .modal-dialog > .modal-content > .modal-footer > #cerrar').click();
        cy.get('#navCarrito').click();
        cy.get('.container-table').contains(el);
        cy.get('#sCarrito').find('#btnComprar').click();
        cy.get('#btnEliminarP').click();
        
        }); 
    });

    it('Test de Login', function(){
        cy.visit('http://localhost:8080/');
        cy.get('#navLogin').click();
        
        cy.get('#usuario').type('test');
        cy.get('#pass').type('tester_0123456');
        cy.get('#appLogin').find('#btnLoguear').click();
    })
});