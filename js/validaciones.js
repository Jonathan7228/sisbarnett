//--------------------- Funcion Solo Numeros en el campo ---------------------------------------------------
function Numeros(e){
	var tecla;
	if(window.event){// Internet Explorer
		tecla = e.keyCode;
	}
	else if(e.which){ // Netscape/Firefox/Opera
		tecla = e.which;
	}
	if (tecla >= 48 && tecla <= 57){
		return true;
	}
	else{
		return false; 
	}
}



//---------------------- Validación Buscar Editar General-------------------------------------------------
function send_form_edit(action,id,view){
	document.form1.view.value=view;
	document.form1.action.value = action;
	document.form1.id.value = id;
	document.form1.submit();
}

//---------------------- Validación Eliminate Product Order-------------------------------------------------
function elimante_product_order(action,id){
	
	document.form1.action.value = action;
	document.form1.id.value = id;
	document.form1.submit();
}



//---------------------- Validacion valcampobusqueda----------------------------------------------------------
function valcampobusqueda(opcion,action){
	
	var cont = 0;
	var errores = '';
	if(action!='buscar'){
		if(opcion!='1'){
			if(document.getElementById("select").options[document.getElementById("select").selectedIndex].value=="*"){
				document.form1.word.disabled=true;
				return;
			}else{
				document.form1.word.disabled=false;
				return;
			}
		}
	}else{
		if(document.getElementById("select").options[document.getElementById("select").selectedIndex].value!="*"){
			if(document.form1.word.value==''){
				errores +='Debe ingresar la palabra de busqueda';
				cont++
				document.form1.word.focus();
			}		
		}
	}
	if(cont != 0){
		alert(errores);
	}else{
		document.form1.action.value=action;
    	document.form1.submit(); 
	}
}


//---------------------- Validacion valcampobusqueda Select Product Order----------------------------------------------------------
function valfielfind(opcion,action){
	
	var cont = 0;
	var errores = '';
	if(action!='buscar'){
		if(opcion!='1'){
			if(document.getElementById("select").options[document.getElementById("select").selectedIndex].value=="*"){
				document.form2.word.disabled=true;
				return;
			}else{
				document.form2.word.disabled=false;
				return;
			}
		}
	}else{
		if(document.getElementById("select").options[document.getElementById("select").selectedIndex].value!="*"){
			if(document.form2.word.value==''){
				errores +='Debe ingresar la palabra de busqueda';
				cont++
				document.form2.word.focus();
			}		
		}
	}
	if(cont != 0){
		alert(errores);
	}else{
		document.form2.action.value=action;
    	document.form2.submit(); 
	}
}



//--------------------- Validation Form Customer ---------------------------------------------------------
function valcustomer(action){
	var cont = 0;
	if(action=='save' || action=='edit'){
		if(action=='save'){
			if(document.getElementById("txtTypePerson").options[document.getElementById("txtTypePerson").selectedIndex].value==""){
				cont++
				document.getElementById('txtTypePerson').style.borderColor='red';
			}else{
				document.getElementById('txtTypePerson').style.borderColor='white';
			}
			if(document.getElementById("txtTypeDocument").options[document.getElementById("txtTypeDocument").selectedIndex].value==""){
				cont++
				document.getElementById('txtTypeDocument').style.borderColor='red';
			}else{
				document.getElementById('txtTypeDocument').style.borderColor='white';
			}
			if(document.form1.txtDocument.value==''){
				cont++
				document.getElementById('txtDocument').style.borderColor='red';
			}else{
				document.getElementById('txtDocument').style.borderColor='white';
			}
			
		}
		if(document.form1.txtFirtsName.value==''){
			cont++
			document.getElementById('txtFirtsName').style.borderColor='red';
		}else{
			document.getElementById('txtFirtsName').style.borderColor='white';
		}
		if(document.form1.txtaddress.value==''){
				cont++
				document.getElementById('txtaddress').style.borderColor='red';
			}else{
				document.getElementById('txtaddress').style.borderColor='white';
			}
		
		if(document.form1.txtPhone.value==''){
				cont++
				document.getElementById('txtPhone').style.borderColor='red';
			}else{
				document.getElementById('txtPhone').style.borderColor='white';
			}
			
		if(document.getElementById("txtTypeDocument").options[document.getElementById("txtTypeDocument").selectedIndex].value!="NIT"){	
			if(document.form1.txtLastName.value==''){
					cont++
					document.getElementById('txtLastName').style.borderColor='red';
				}else{
					document.getElementById('txtLastName').style.borderColor='white';
				}
			if(document.form1.txtSecondLastName.value==''){
					cont++
					document.getElementById('txtSecondLastName').style.borderColor='red';
				}else{
					document.getElementById('txtSecondLastName').style.borderColor='white';
				}
		}else{
			document.getElementById('txtLastName').style.borderColor='white';
			document.getElementById('txtSecondLastName').style.borderColor='white';
		}
		if(document.form1.txtCity.value==''){
			cont++
			document.getElementById('txtCity').style.borderColor='red';
		}else{
			document.getElementById('txtCity').style.borderColor='white';
		}
		if(document.form1.txtPhone.value==''){
			cont++
			document.getElementById('txtPhone').style.borderColor='red';
		}else{
			document.getElementById('txtPhone').style.borderColor='white';
		}
	
	}
	if(cont != 0){
		alert('Debe Ingresar los datos requeridos del Cliente');
	}else{
		document.form1.action.value=action;
    	document.form1.submit(); 
	}
}

//--------------------- Validation Form Product ---------------------------------------------------------
function valproduct(action){
	var cont = 0;
	if(action=='save' || action=='edit'){
		if(document.form1.txtCod.value==''){
			cont++
			document.getElementById('txtCod').style.borderColor='red';
		}else{
			document.getElementById('txtCod').style.borderColor='white';
		}
			
		if(document.form1.txtDescription.value==''){
			cont++
			document.getElementById('txtDescription').style.borderColor='red';
		}else{
			document.getElementById('txtDescription').style.borderColor='white';
		}
		
		if(document.form1.dbValue.value==''){
			cont++
			document.getElementById('dbValue').style.borderColor='red';
		}else{
			document.getElementById('dbValue').style.borderColor='white';
		}
	}
	
	if(cont != 0){
		alert('Debe Ingresar los datos requeridos');
	}else{
		document.form1.action.value=action;
    	document.form1.submit(); 
	}
}

//--------------------- Validation Form Inventario ---------------------------------------------------------
function valinventory(action){
	var cont = 0;
	if(action=='save' || action=='edit'){
		if(document.form1.intQuantity.value==''){
			cont++
			document.getElementById('intQuantity').style.borderColor='red';
		}else{
			document.getElementById('intQuantity').style.borderColor='white';
		}
	}
	
	if(cont != 0){
		alert('Debe Ingresar los datos requeridos');
	}else{
		document.form1.action.value=action;
    	document.form1.submit(); 
	}
}

//--------------------- Validacion del Form Users------------------------------------------------------------
function valuser(action){
	var cont = 0;
	if(action=='save'){
		
		if(document.form1.txtDocument.value==''){
			cont++
			document.getElementById('txtDocument').style.borderColor='red';
		}else{
			document.getElementById('txtDocument').style.borderColor='white';
		}
	
		if(document.getElementById("intProfile").options[document.getElementById("intProfile").selectedIndex].value==""){
			cont++
			document.getElementById('intProfile').style.borderColor='red';
		}else{
			document.getElementById('intProfile').style.borderColor='white';
		}
		if(document.form1.txtName.value==''){
			cont++
			document.getElementById('txtName').style.borderColor='red';
		}else{
			document.getElementById('txtName').style.borderColor='white';
		}
		if(document.form1.txtPassword.value==''){
			cont++
			document.getElementById('txtPassword').style.borderColor='red';
		}else{
			document.getElementById('txtPassword').style.borderColor='white';
		}
		if(document.form1.txtPassword2.value==''){
			cont++
			document.getElementById('txtPassword2').style.borderColor='red';
		}else{
			document.getElementById('txtPassword2').style.borderColor='white';
		}
		if(document.form1.txtPassword.value!=document.form1.txtPassword2.value){
			alert('Las Contraseñas no coinciden, Verifica por favor!');
			document.form1.txtPassword.value=''
			document.form1.txtPassword2.value=''
			document.form1.txtPassword.focus();
			return;
		}
		
	}
	if(cont != 0){
		alert('Debe Ingresar todos los datos en el formulario');
	}else{
		document.form1.action.value=action;
    	document.form1.submit(); 
	}
}

function selectProduct(id,action){
	document.form2.action.value=action;
	document.form2.id.value=id;
    document.form2.submit();
	
}

function valSubtotal(idfield,val,invent){
	var total=0;
	cant = document.getElementById("intQuantity"+idfield+"").value;
	if(parseInt(cant)<=parseInt(invent)){
		subtotal=(cant*val);
		document.getElementById("subTotal"+idfield+"").value=subtotal;
		subtotal = parseFloat(subtotal);
		$(".subtotalproduct").each(function(index, element) {
			if($(this).val()!=""){
				total = total  + parseInt($(this).val());
			}
		});
			document.getElementById("Total").value = total;
	}else{
		alert('La Cantidad no puede superar al del inventario');
		document.getElementById("intQuantity"+idfield+"").value='';
	}
	return;
	
	/*$(".subtotalproduct").each(function(index, element) {
		alert($(this).val());
        total += $(this).val();
    });
	$("#Total").val(total);*/
}

//--------------------- Validation Form Order ---------------------------------------------------------
function valorder(action){
	var cont = 0;
	if(action=='save' || action=='edit'){
		if(document.form1.Total.value==''){
			cont++
		}
	}
	
	if(cont != 0){
		alert('Debe Ingresar la Cantidad');
		return;
	}else{
		document.form1.action.value=action;
    	document.form1.submit(); 
	}
}
