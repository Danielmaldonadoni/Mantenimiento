//opcion_personal = document.getElementById("personal_slc");
var i=0;

function insertaPersonal(personal_slc){
  var insert = document.getElementById("inserta-personal");

  if(i==0){
		//insert.innerHTML = "<br>";
		insert.innerHTML += "<textarea style='border-radius:4px;border: 1px solid #ccc;' name='personal_txt' id='personal_txt' title='Personal agregado'required >"+personal_slc.value+"</textarea>";
  }else{
    var insertaMiembro = document.getElementById("personal_txt");
    if(personal_slc.value==""){

    }else{
      insertaMiembro.value += ", "+personal_slc.value;
    }
  }
  i++;

}