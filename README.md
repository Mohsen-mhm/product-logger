# Product logger with PHP & mySQL & Smarty

## This is a product logger project.

--------------------------------------------------

First, refer to the <product_logger.sql> and run it in your database to create the relevant tables.

*then*

## check your *MySql* username and password at <db.php> file

_run project_

--------------------------------------------------

Use the `postMan` or similar platforms to send requests to <checkVersion.php>:
(Use GET method)

### Reaquest Header :

Version             :     example(0.0.3)
Resource-Name       :     example(product1)
Additional-info     :     example( json( {"name":"name server","oneCync":"enabale"} ) )

## Ready to go, Add your product, add new version and edit it on info page then send your request for your products version :)


