/* Add Item to Cart By Click the ItemBox */

var productBoxs = document.getElementsByClassName("box");
var myStorage = localStorage
var existingProducts =  JSON.parse(myStorage.getItem('selectedProductArray'))
var cancelCartBtn = document.getElementById('submitcancelcart')
let itemQuantity = 1;

// check whether selected Item is existing in the cart, return the index of selected item
function isItemSelected(itemName){
    if(existingProducts != null){
        for(let i = 0; i < existingProducts.length ; i++){
            if(itemName === existingProducts[i].name){
                itemQuantity = existingProducts[i].qty + 1
                return i
            }
        }
        return false
    }
    else{
        return false
    }
}
// clear the selectedProductsArray, only called when cancelbtn is clicked
function clearCart(){
    myStorage.removeItem('selectedProductArray')
    location.reload()
}



// Get selected item name , price; modify slectedProductsArray which stored in LocalStorage
function handleCartClick(i,itemNamePostedByCalculator){
    // another payment function, only apply to special products.
                    /*  Special Product List
                        "Take Away"
                        "No Tax product"
                        "product"
                        "Tomato"
                        "Apple"
                        "Carrot"
                        "Onion"
                        "Mushroom"
                        "banana"
                        "lemon_"
                        "redonion"
                        "capsicum"
                        "zucchini"
                        "Vegie"
                        "JOURNAL&CARD"
                        "CHIPS"        */
    if(itemNamePostedByCalculator !== undefined){
        let itemPrice = document.getElementById('result').value.slice(2)
        let itemName = itemNamePostedByCalculator
        let thisProduct = 
        {
            'name' : itemName,
            'price' : itemPrice,
            'qty' : itemQuantity,
            'subTotal' : itemPrice * itemQuantity
        }
        selectedProductsArray.unshift(thisProduct)
    }
    // code below only triggered when the second parameter is not passed, which means this function is called by clicking normal items
    else{
        let itemName = productBoxs[i].getAttribute('value')
        if(itemName == "Take Away"
        ||itemName == "No Tax product"
        ||itemName == "product"
        ||itemName == "Tomato"
        ||itemName == "Apple"
        ||itemName == "Carrot"
        ||itemName == "Onion"
        ||itemName == "Mushroom"
        ||itemName == "banana"
        ||itemName == "lemon_"
        ||itemName == "redonion"
        ||itemName == "capsicum"
        ||itemName == "zucchini"
        ||itemName == "Vegie"
        ||itemName == "JOURNAL&CARD"
        ||itemName == "CHIPS" ){
        productname = document.getElementById('selectedcalitem').value;
        return
        }
        let itemPriceString = productBoxs[i].children[1].children[1].innerHTML.replace(/[^\d.]/g,'')
        let itemPrice = Number(itemPriceString)
        var index = isItemSelected(itemName)
        let thisProduct = 
        {
            'name' : itemName,
            'price' : itemPrice,
            'qty' : itemQuantity,
            'subTotal' : itemPrice * itemQuantity
        }
        if(index!==false){
            // change the item which index point to
            selectedProductsArray[index] = 
            {
            'name' : itemName,
            'price' : itemPrice,
            'qty' : itemQuantity,
            'subTotal' : itemPrice * itemQuantity,
            }        
        }
        else
        {
            selectedProductsArray.unshift(thisProduct)
        }
    }
    myStorage.setItem('selectedProductArray', JSON.stringify(selectedProductsArray))
}


// initialize the selectedProductsArray
if(existingProducts != null){
    var selectedProductsArray = existingProducts
}
else{
    var selectedProductsArray = []
}
// bind handleCartClick function to each itemBox element
for (let i = 0; i < productBoxs.length ; i++){
    //add event listener on each cart
    productBoxs[i].addEventListener('click', () => handleCartClick(i))

}
// bind clearCart function to each cancelCartBtn element
cancelCartBtn.addEventListener('click',()=>{
    clearCart()
})

/* Update Cart View */

const cartNode = document.getElementsByClassName('cartList')[0]
const totalItemNode = document.getElementById('total')
const totalPriceNode = document.getElementById('gross_price')
let grossPrice = 0
let totalQty = 0

// delete targeted Item in the selectedProductsArray, refresh the page so that the view port will show updated data.; bind to the cancelItemBtn
function deleteItem(i){
    updatedArray = selectedProductsArray.filter(function(value,index,arr){
        return index !== i
    })
    myStorage.setItem('selectedProductArray',JSON.stringify(updatedArray))
    location.reload()
}

// minus targeted item quantity by 1 everytime the minusBtn is clicked, minimon quantity equals 1
function minusItemQuantity(i){
    if(selectedProductsArray[i].qty > 1){
        selectedProductsArray[i].qty -= 1
        selectedProductsArray[i].subTotal -= selectedProductsArray[i].price
        myStorage.setItem('selectedProductArray',JSON.stringify(selectedProductsArray))
    }
    else{
        selectedProductsArray[i].qty = 1
    }
    location.reload()
}

// add targeted item quantity by 1 everytime the addBtn is clicked
function addItemQuantity(i){
    selectedProductsArray[i].qty += 1
    selectedProductsArray[i].subTotal += selectedProductsArray[i].price
    myStorage.setItem('selectedProductArray',JSON.stringify(selectedProductsArray))
    location.reload()
}

// cart control 
if(existingProducts != null){
    // add existing items to cart view
    for(let i = 0 ; i < selectedProductsArray.length; i++){
        let {name,qty,subTotal} = selectedProductsArray[i]
        subTotal = Math.floor(subTotal * 100) /100
        cartNode.innerHTML += '<th width="50px">'+(i+1)+'</th>' + 
        '<th width="150px">'+name+'</th>' + 
        '<th width="120px" style="text-align:center;"> <button class ="addQty" style= "margin-right:5px"> + </button> '+qty+' <button class = "minusQty" style= "margin-left : 5px"> - </button> </th>' + 
        '<th width="100px">'+subTotal+'</th>' +
        '<th width="5px">' +
        '<button data-toggle="modal" data-target="cancelItem" class="btn btn-danger btn-xs"><i class="fa fa-times" ></i></button>' +
        '</th>'    

        // caculate & show price
        grossPrice += subTotal 
        totalQty += qty
        totalItemNode.innerText = totalQty
        totalPriceNode.innerText = '$' + Math.floor(grossPrice * 100) /100
    }
}
// ***IMPORTANT***  This part have to be placed under cart control section
// bind delete function to each cancel button 
const cancelItemBtn = $('[data-target="cancelItem"]')
const addQtyBtns = document.getElementsByClassName('addQty')
const minusQtyBtns = document.getElementsByClassName('minusQty')
for( let i = 0 ; i < cancelItemBtn.length ; i++){
    cancelItemBtn[i].addEventListener('click', () => deleteItem(i))
} 
for( let i = 0 ; i < addQtyBtns.length ; i++){
    addQtyBtns[i].addEventListener('click', () => addItemQuantity(i))
    minusQtyBtns[i].addEventListener('click', () => minusItemQuantity(i))
} 



