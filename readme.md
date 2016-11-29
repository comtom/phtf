# Esbozo de framework en Php creado para la materia Programacion C

## Patron MTV (modelo-vista-template)
* El modelo se maneja con stored procedures en la DB.
* Las vistas se encuentran en /views, se acceden automaticamente por medio del router (index.php). Se puede importar una vista desde otra con la funcion view()
* Los templates se resuelven mediante con la funcion template() y se encuentran en /templates
* El codigo javascript que necesite generacion dinamica debe colocarse en /templates/js y se resuelven con la funcion javascript()


## Notas
* Tanto las vistas como templates, pueden renderizarse por medio de una variable utilizando la funcion get_include_contents()

## Version
* 0.2 desarrollada por Tomás González Dowling (tomas@comtom.com.ar) - 03/09/2014 -


