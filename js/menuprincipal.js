
//USETEXTLINKS = 1

//STARTALLOPEN = 0

//ICONPATH = ''


foldersTree = gFld("<i>Inicio</i>", "fondo_presentacion.php")
  //foldersTree.treeID = "Frameset"
	aux1 = insFld(foldersTree, gFld("Clientes", "javascript:parent.op()"))
		insDoc(aux1, gLnk("R", "Crear", "forms/CreateCustomer.php"))
		insDoc(aux1, gLnk("R", "Buscar", "forms/FindCustomer.php"))
		insDoc(aux1, gLnk("R", "Registros", "forms/FindRecordCustomer.php"))
		
  	aux1 = insFld(foldersTree, gFld("Productos", "javascript:parent.op()"))
			insDoc(aux1, gLnk("R", "Crear", "forms/CreateProduct.php"))
			insDoc(aux1, gLnk("R", "Buscar", "forms/FindProduct.php"))
			insDoc(aux1, gLnk("R", "Registros", "forms/FindRecordProduct.php"))
	
	aux1 = insFld(foldersTree, gFld("Inventarios", "javascript:parent.op()"))
			insDoc(aux1, gLnk("R", "Insertar", "forms/FindProductInventory.php"))
			insDoc(aux1, gLnk("R", "Consultar", "forms/FindInventory.php"))
			insDoc(aux1, gLnk("R", "Registros", "forms/FindRecordInventory.php"))
			
	aux1 = insFld(foldersTree, gFld("Ordenes de Pedido", "javascript:parent.op()"))
		insDoc(aux1, gLnk("R", "Crear", "forms/FindCustomerOrder.php"))
		insDoc(aux1, gLnk("R", "Buscar", "forms/SelectFindOrder.php"))
		insDoc(aux1, gLnk("R", "Registros", "forms/FindRecordOrder.php"))
		
  	aux1 = insFld(foldersTree, gFld("Usuarios", "javascript:parent.op()"))
		insDoc(aux1, gLnk("R", "Crear", "forms/CreateUser.php"))
		insDoc(aux1, gLnk("R", "Buscar", "forms/FindUser.php"))
		insDoc(aux1, gLnk("R", "Registros", "forms/FindRecordUser.php"))
	
	
    // JavaScript Document