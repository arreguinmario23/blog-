mensajes = [{id:'1',tema:'Programacion', mensaje:'Hola mundo', usuario:'admin', fecha:'2020-09-28'}, 
            {id:'2',tema:'Programacion', mensaje:'Como estan', usuario:'juan', fecha:'2020-09-28'}];

msgId = 2;
idaeliminar = 0;
idaeditar = 0;
consulta();
//actualizar();
console.log(mensajes);

$("#nombreTema").text(sessionStorage.getItem('tema'));

function agregarMensaje(){
    let id = sessionStorage.getItem("idtema");
    let msg = $("#mensaje").val();
    //console.log(id);
    //console.log(msg);
    $.getJSON("crud_mensajes.php",{operacion:'C', idtema:id, mensaje:msg}).done(function(datos){
        //console.log(datos);
        if(datos.resp == "si"){
            consulta();
        }else{
            $('.toast').toast('show')
        }
    }).fail(function(error){
        //console.log(error);
    });

    // let msg = $("#mensaje").val();
    // msgId ++;
    // nuevoMsg = {id: msgId,tema:'Programacion', mensaje: msg, usuario:'juan', fecha:'2020-09-28'};
    // mensajes.push(nuevoMsg);
    // console.log(mensajes);
    // actualizar();
}

function actualizar(){
    $("#tablaTemas").html('');
    for(let i = 0 ; i < mensajes.length; i++){
        let fila = "<tr><td>" + mensajes[i].id + "</td><td>" + mensajes[i].tema + "</td><td>" + mensajes[i].mensaje + "</td><td>" + mensajes[i].usuario  + "</td><td>" + mensajes[i].fecha +"</td>";
        fila = fila + "<td><button onclick='editarMsg("+ mensajes[i].id +");' class='btn btn-primary' data-toggle='modal' data-target='#modificaTema'>";
        fila += "<i class='material-icons align-middle'>edit</i></button>";
        fila += "<button onclick='eliminarMsg("+ mensajes[i].id +");' class='btn btn-danger' data-toggle='modal' data-target='#eliminaTema'>";
        fila += "<i class='material-icons align-middle'>cancel</i></button></td></tr>";
        //console.log(fila);
        $("#tablaTemas").append(fila);
    }
    
}

function editarMsg(id){
    for(let i = 0 ; i < mensajes.length; i++){
        if(mensajes[i].id==id){
            $("#msgEditar").val(mensajes[i].mensaje);
            idaeditar = id;
            break;
        }
    }
}

function eliminarMsg(id){
    idaeliminar = id;
}

function confirmaEliminar(){
    $.getJSON("crud_mensajes.php",{operacion:'D', idmsg: idaeliminar}).done(function(datos){
        console.log(datos);
        if(datos.resp == "si"){
            consulta();
        }else{
            $('.toast').toast('show')
        }
    }).fail(function(error){
        console.log(error);
    });
    // for(let i = 0 ; i < mensajes.length; i++){
    //     if(mensajes[i].id==idaeliminar){
    //         mensajes.splice(i,1);
    //         break;
    //     }
    // }
    // actualizar();
}

function guardaCambios(){
    let msg = $("#msgEditar").val();
    $.getJSON("crud_mensajes.php",{operacion:'U', idmsg: idaeditar, mensaje: msg}).done(function(datos){
        console.log(datos);
        if(datos.resp == "si"){
            consulta();
        }else{
            $('.toast').toast('show')
        }
    }).fail(function(error){
        console.log(error);
    });
    // for(let i = 0 ; i < mensajes.length; i++){
    //     if(mensajes[i].id==idaeditar){
    //         mensajes[i].mensaje = $("#msgEditar").val();
    //         break;
    //     }
    // }
    // actualizar();
}

/* Conexion a base de datos */
/* Consulta*/
function consulta(){
    let id = sessionStorage.getItem("idtema");
    $.getJSON("crud_mensajes.php", {operacion:'R', idtema:id}).done(function(datos){
        //console.log(datos);
        mensajes = datos;
        actualizar();
    }).fail(function(e){
        console.log(e);
    });
}