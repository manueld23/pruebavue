describe('Search test cases', function(){
    it('Vista de productos', function(){
        cy.visit('http://localhost:8080/');
        cy.get('#navProductos').click();

        cy.get('#sProductos').find('#idProducto').invoke("text").then((el) =>{
            console.log(el);

        //cy.get(':nth-child(1) > .card > .card-body > #btnModal').click();
        cy.get('#sProductos').find('#btnModal').click();
        //cy.get('#aumentar > #cantidadProducto').select('2');
        cy.get('#cantidadProducto').select('2');
        //cy.get(`#exampleModal/${el} > .modal-dialog > .modal-content > .modal-body > #agregarCarrito`).click();
        cy.get('#agregarCarrito').click();

        cy.get('#exampleModal > .modal-dialog > .modal-content > .modal-footer > #cerrar').click();
        }); 
    });

    it('Test de carrito de compras', function(){
        cy.visit('http://localhost:8080/');
        cy.get('#navProductos').click();

        cy.get('#sProductos').find('#idProducto').invoke("text").then((el) =>{
            console.log(el);

        cy.get('#sProductos').find('#btnModal').click();
        //cy.get('#aumentar > #cantidadProducto').select('2');
        cy.get('#cantidadProducto').select('2');
        //cy.get(`#exampleModal/${el} > .modal-dialog > .modal-content > .modal-body > #agregarCarrito`).click();
        cy.get('#agregarCarrito').click();

        cy.get('#exampleModal > .modal-dialog > .modal-content > .modal-footer > #cerrar').click();
        }); 
        cy.get('#navCarrito').click();

        cy.get('#btnEliminarP').click();
        cy.get('#sCarrito').find('#btnComprar').click();
    });

    it('Test de Login', function(){
        cy.visit('http://localhost:8080/');
        cy.get('#navLogin').click();

        cy.get('#appLogin').find('#btnLoguear').click();
    })
});