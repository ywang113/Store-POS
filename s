[1mdiff --git a/api/categories.js b/api/categories.js[m
[1mdeleted file mode 100644[m
[1mindex 125b36c..0000000[m
[1m--- a/api/categories.js[m
[1m+++ /dev/null[m
[36m@@ -1,71 +0,0 @@[m
[31m-const app = require( "express" )();[m
[31m-const server = require( "http" ).Server( app );[m
[31m-const bodyParser = require( "body-parser" );[m
[31m-const Datastore = require( "nedb" );[m
[31m-const async = require( "async" );[m
[31m-[m
[31m-[m
[31m-app.use( bodyParser.json() );[m
[31m-[m
[31m-module.exports = app;[m
[31m-[m
[31m- [m
[31m-let categoryDB = new Datastore( {[m
[31m-    filename: process.env.APPDATA+"/POS/server/databases/categories.db",[m
[31m-    autoload: true[m
[31m-} );[m
[31m-[m
[31m-[m
[31m-categoryDB.ensureIndex({ fieldName: '_id', unique: true });[m
[31m-app.get( "/", function ( req, res ) {[m
[31m-    res.send( "Category API" );[m
[31m-} );[m
[31m-[m
[31m-[m
[31m-  [m
[31m-app.get( "/all", function ( req, res ) {[m
[31m-    categoryDB.find( {}, function ( err, docs ) {[m
[31m-        res.send( docs );[m
[31m-    } );[m
[31m-} );[m
[31m-[m
[31m- [m
[31m-app.post( "/category", function ( req, res ) {[m
[31m-    let newCategory = req.body;[m
[31m-    newCategory._id = Math.floor(Date.now() / 1000); [m
[31m-    categoryDB.insert( newCategory, function ( err, category) {[m
[31m-        if ( err ) res.status( 500 ).send( err );[m
[31m-        else res.sendStatus( 200 );[m
[31m-    } );[m
[31m-} );[m
[31m-[m
[31m-[m
[31m-[m
[31m-app.delete( "/category/:categoryId", function ( req, res ) {[m
[31m-    categoryDB.remove( {[m
[31m-        _id: parseInt(req.params.categoryId)[m
[31m-    }, function ( err, numRemoved ) {[m
[31m-        if ( err ) res.status( 500 ).send( err );[m
[31m-        else res.sendStatus( 200 );[m
[31m-    } );[m
[31m-} );[m
[31m-[m
[31m- [m
[31m-[m
[31m- [m
[31m-app.put( "/category", function ( req, res ) {[m
[31m-    categoryDB.update( {[m
[31m-        _id: parseInt(req.body.id)[m
[31m-    }, req.body, {}, function ([m
[31m-        err,[m
[31m-        numReplaced,[m
[31m-        category[m
[31m-    ) {[m
[31m-        if ( err ) res.status( 500 ).send( err );[m
[31m-        else res.sendStatus( 200 );[m
[31m-    } );[m
[31m-});[m
[31m-[m
[31m-[m
[31m-[m
[31m- [m
\ No newline at end of file[m
[1mdiff --git a/api/customers.js b/api/customers.js[m
[1mdeleted file mode 100644[m
[1mindex 7f30c66..0000000[m
[1m--- a/api/customers.js[m
[1m+++ /dev/null[m
[36m@@ -1,85 +0,0 @@[m
[31m-const app = require( "express" )();[m
[31m-const server = require( "http" ).Server( app );[m
[31m-const bodyParser = require( "body-parser" );[m
[31m-const Datastore = require( "nedb" );[m
[31m-const async = require( "async" );[m
[31m-[m
[31m-app.use( bodyParser.json() );[m
[31m-[m
[31m-module.exports = app;[m
[31m-[m
[31m- [m
[31m-let customerDB = new Datastore( {[m
[31m-    filename: process.env.APPDATA+"/POS/server/databases/customers.db",[m
[31m-    autoload: true[m
[31m-} );[m
[31m-[m
[31m-[m
[31m-customerDB.ensureIndex({ fieldName: '_id', unique: true });[m
[31m-[m
[31m-[m
[31m-app.get( "/", function ( req, res ) {[m
[31m-    res.send( "Customer API" );[m
[31m-} );[m
[31m-[m
[31m-[m
[31m-app.get( "/customer/:customerId", function ( req, res ) {[m
[31m-    if ( !req.params.customerId ) {[m
[31m-        res.status( 500 ).send( "ID field is required." );[m
[31m-    } else {[m
[31m-        customerDB.findOne( {[m
[31m-            _id: req.params.customerId[m
[31m-        }, function ( err, customer ) {[m
[31m-            res.send( customer );[m
[31m-        } );[m
[31m-    }[m
[31m-} );[m
[31m-[m
[31m- [m
[31m-app.get( "/all", function ( req, res ) {[m
[31m-    customerDB.find( {}, function ( err, docs ) {[m
[31m-        res.send( docs );[m
[31m-    } );[m
[31m-} );[m
[31m-[m
[31m- [m
[31m-app.post( "/customer", function ( req, res ) {[m
[31m-    var newCustomer = req.body;[m
[31m-    customerDB.insert( newCustomer, function ( err, customer ) {[m
[31m-        if ( err ) res.status( 500 ).send( err );[m
[31m-        else res.sendStatus( 200 );[m
[31m-    } );[m
[31m-} );[m
[31m-[m
[31m-[m
[31m-[m
[31m-app.delete( "/customer/:customerId", function ( req, res ) {[m
[31m-    customerDB.remove( {[m
[31m-        _id: req.params.customerId[m
[31m-    }, function ( err, numRemoved ) {[m
[31m-        if ( err ) res.status( 500 ).send( err );[m
[31m-        else res.sendStatus( 200 );[m
[31m-    } );[m
[31m-} );[m
[31m-[m
[31m- [m
[31m-[m
[31m- [m
[31m-app.put( "/customer", function ( req, res ) {[m
[31m-    let customerId = req.body._id;[m
[31m-[m
[31m-    customerDB.update( {[m
[31m-        _id: customerId[m
[31m-    }, req.body, {}, function ([m
[31m-        err,[m
[31m-        numReplaced,[m
[31m-        customer[m
[31m-    ) {[m
[31m-        if ( err ) res.status( 500 ).send( err );[m
[31m-        else res.sendStatus( 200 );[m
[31m-    } );[m
[31m-});[m
[31m-[m
[31m-[m
[31m-[m
[31m- [m
\ No newline at end of file[m
[1mdiff --git a/api/inventory.js b/api/inventory.js[m
[1mdeleted file mode 100644[m
[1mindex d560fd4..0000000[m
[1m--- a/api/inventory.js[m
[1m+++ /dev/null[m
[36m@@ -1,178 +0,0 @@[m
[31m-const app = require( "express" )();[m
[31m-const server = require( "http" ).Server( app );[m
[31m-const bodyParser = require( "body-parser" );[m
[31m-const Datastore = require( "nedb" );[m
[31m-const async = require( "async" );[m
[31m-const fileUpload = require('express-fileupload');[m
[31m-const multer = require("multer");[m
[31m-const fs = require('fs');[m
[31m-[m
[31m-[m
[31m-const storage = multer.diskStorage({[m
[31m-    destination: process.env.APPDATA+'/POS/uploads',[m
[31m-    filename: function(req, file, callback){[m
[31m-        callback(null, Date.now() + '.jpg'); // [m
[31m-    }[m
[31m-});[m
[31m-[m
[31m-[m
[31m-let upload = multer({storage: storage});[m
[31m-[m
[31m-app.use(bodyParser.json());[m
[31m-[m
[31m-[m
[31m-module.exports = app;[m
[31m-[m
[31m- [m
[31m-let inventoryDB = new Datastore( {[m
[31m-    filename: process.env.APPDATA+"/POS/server/databases/inventory.db",[m
[31m-    autoload: true[m
[31m-} );[m
[31m-[m
[31m-[m
[31m-inventoryDB.ensureIndex({ fieldName: '_id', unique: true });[m
[31m-[m
[31m- [m
[31m-app.get( "/", function ( req, res ) {[m
[31m-    res.send( "Inventory API" );[m
[31m-} );[m
[31m-[m
[31m-[m
[31m- [m
[31m-app.get( "/product/:productId", function ( req, res ) {[m
[31m-    if ( !req.params.productId ) {[m
[31m-        res.status( 500 ).send( "ID field is required." );[m
[31m-    } else {[m
[31m-        inventoryDB.findOne( {[m
[31m-            _id: parseInt(req.params.productId)[m
[31m-        }, function ( err, product ) {[m
[31m-            res.send( product );[m
[31m-        } );[m
[31m-    }[m
[31m-} );[m
[31m-[m
[31m-[m
[31m- [m
[31m-app.get( "/products", function ( req, res ) {[m
[31m-    inventoryDB.find( {}, function ( err, docs ) {[m
[31m-        res.send( docs );[m
[31m-    } );[m
[31m-} );[m
[31m-[m
[31m-[m
[31m- [m
[31m-app.post( "/product", upload.single('imagename'), function ( req, res ) {[m
[31m-[m
[31m-    let image = '';[m
[31m-[m
[31m-    if(req.body.img != "") {[m
[31m-        image = req.body.img;        [m
[31m-    }[m
[31m-[m
[31m-    if(req.file) {[m
[31m-        image = req.file.filename;  [m
[31m-    }[m
[31m- [m
[31m-[m
[31m-    if(req.body.remove == 1) {[m
[31m-        const path = './resources/app/public/uploads/product_image/'+ req.body.img;[m
[31m-        try {[m
[31m-          fs.unlinkSync(path)[m
[31m-        } catch(err) {[m
[31m-          console.error(err)[m
[31m-        }[m
[31m-[m
[31m-        if(!req.file) {[m
[31m-            image = '';[m
[31m-        }[m
[31m-    }[m
[31m-    [m
[31m-    let Product = {[m
[31m-        _id: parseInt(req.body.id),[m
[31m-        price: req.body.price,[m
[31m-        category: req.body.category,[m
[31m-        quantity: req.body.quantity == "" ? 0 : req.body.quantity,[m
[31m-        name: req.body.name,[m
[31m-        stock: req.body.stock == "on" ? 0 : 1,    [m
[31m-        img: image        [m
[31m-    }[m
[31m-[m
[31m-    if(req.body.id == "") { [m
[31m-        Product._id = Math.floor(Date.now() / 1000);[m
[31m-        inventoryDB.insert( Product, function ( err, product ) {[m
[31m-            if ( err ) res.status( 500 ).send( err );[m
[31m-            else res.send( product );[m
[31m-        });[m
[31m-    }[m
[31m-    else { [m
[31m-        inventoryDB.update( {[m
[31m-            _id: parseInt(req.body.id)[m
[31m-        }, Product, {}, function ([m
[31m-            err,[m
[31m-            numReplaced,[m
[31m-            product[m
[31m-        ) {[m
[31m-            if ( err ) res.status( 500 ).send( err );[m
[31m-            else res.sendStatus( 200 );[m
[31m-        } );[m
[31m-[m
[31m-    }[m
[31m-[m
[31m-});[m
[31m-[m
[31m-[m
[31m-[m
[31m- [m
[31m-app.delete( "/product/:productId", function ( req, res ) {[m
[31m-    inventoryDB.remove( {[m
[31m-        _id: parseInt(req.params.productId)[m
[31m-    }, function ( err, numRemoved ) {[m
[31m-        if ( err ) res.status( 500 ).send( err );[m
[31m-        else res.sendStatus( 200 );[m
[31m-    } );[m
[31m-} );[m
[31m-[m
[31m- [m
[31m-[m
[31m-app.post( "/product/sku", function ( req, res ) {[m
[31m-    var request = req.body;[m
[31m-    inventoryDB.findOne( {[m
[31m-            _id: parseInt(request.skuCode)[m
[31m-    }, function ( err, product ) {[m
[31m-         res.send( product );[m
[31m-    } );[m
[31m-} );[m
[31m-[m
[31m- [m
[31m-[m
[31m-[m
[31m-app.decrementInventory = function ( products ) {[m
[31m-[m
[31m-    async.eachSeries( products, function ( transactionProduct, callback ) {[m
[31m-        inventoryDB.findOne( {[m
[31m-            _id: parseInt(transactionProduct.id)[m
[31m-        }, function ([m
[31m-            err,[m
[31m-            product[m
[31m-        ) {[m
[31m-    [m
[31m-            if ( !product || !product.quantity ) {[m
[31m-                callback();[m
[31m-            } else {[m
[31m-                let updatedQuantity =[m
[31m-                    parseInt( product.quantity) -[m
[31m-                    parseInt( transactionProduct.quantity );[m
[31m-[m
[31m-                inventoryDB.update( {[m
[31m-                        _id: parseInt(product._id)[m
[31m-                    }, {[m
[31m-                        $set: {[m
[31m-                            quantity: updatedQuantity[m
[31m-                        }[m
[31m-                    }, {},[m
[31m-                    callback[m
[31m-                );[m
[31m-            }[m
[31m-        } );[m
[31m-    } );[m
[31m-};[m
\ No newline at end of file[m
[1mdiff --git a/api/settings.js b/api/settings.js[m
[1mdeleted file mode 100644[m
[1mindex d75540f..0000000[m
[1m--- a/api/settings.js[m
[1m+++ /dev/null[m
[36m@@ -1,111 +0,0 @@[m
[31m-const app = require( "express")();[m
[31m-const server = require( "http" ).Server( app );[m
[31m-const bodyParser = require( "body-parser" );[m
[31m-const Datastore = require( "nedb" );[m
[31m-const multer = require("multer");[m
[31m-const fileUpload = require('express-fileupload');[m
[31m-const fs = require('fs');[m
[31m-[m
[31m-[m
[31m-const storage = multer.diskStorage({[m
[31m-    destination:  process.env.APPDATA+'/POS/uploads',[m
[31m-    filename: function(req, file, callback){[m
[31m-        callback(null, Date.now() + '.jpg'); // [m
[31m-    }[m
[31m-});[m
[31m-[m
[31m-let upload = multer({storage: storage});[m
[31m-[m
[31m-app.use( bodyParser.json() );[m
[31m-[m
[31m-module.exports = app;[m
[31m-[m
[31m- [m
[31m-let settingsDB = new Datastore( {[m
[31m-    filename: process.env.APPDATA+"/POS/server/databases/settings