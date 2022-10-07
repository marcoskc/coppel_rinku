<html>

<head>
    <title>Menú RINKU</title>
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="css/menu_page.css" />
</head>

<body>
    <div id='barmenu'><b>- MENÚ -</div>
    <div id='menu'>
        <form method='post' action='content/lista_trabajadores.php' target='contenedor'>
            <input style='width:90px' type='image' src='resource/boton_menu_01.png' alt='Submit'>
        </form>
        <form method='post' action='content/alta_empleado.php' target='contenedor'>
            <input style='width:90px' type='image' src='resource/boton_menu_02.png' alt='Submit'>
        </form>
        <form method='post' action='content/alta_corte.php' target='contenedor'>
            <input style='width:90px' type='image' src='resource/boton_menu_03.png' alt='Submit'>
        </form>
        <input style='width:90px' type='image' src='resource/boton_menu_04.png' onClick="printlayout()">
    </div>
</body>

<script>
function printlayout() {
    var DocumentContainer = parent.frames["contenedor"].document.getElementById('impresion_box');
    var WindowObject = window.open('', "Lista de Registros",
        "width=800,height=600,top=20,left=20,margin=0,0,0,0,toolbars=no,scrollbars=yes,status=no,resizable=no");
    WindowObject.document.writeln("<html><head><title>Dialogo de Impresión</title></head><body>" + DocumentContainer.innerHTML+"</body></html>");
    WindowObject.document.close();
    WindowObject.focus();
    WindowObject.print();
    WindowObject.close();
}
</script>

</html>