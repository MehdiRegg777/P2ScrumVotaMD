document.addEventListener("DOMContentLoaded", function(){
    let parentElem = document.getElementsByClassName("pc_options")[0];
    toggleButtonDelete();
    // add un event listener para los inputs no eliminables
    let title = document.getElementsByTagName('input')[0]
    title.addEventListener("click", function () {
        deleteEverythingBelow(title);
    });
    
    let dateStart = document.getElementsByTagName('input')[1]
    dateStart.addEventListener("click", function () {
        deleteEverythingBelow(dateStart);
    });

    let dateEnd = document.getElementsByTagName('input')[2]
    dateEnd.addEventListener("click", function () {
        deleteEverythingBelow(dateEnd);
    });

    let op1 = document.getElementsByTagName('input')[3]
    op1.addEventListener("click", function () {
        deleteEverythingBelow(op1);
    });

    let op2 = document.getElementsByTagName('input')[4]
    op2.addEventListener("click", function () {
        deleteEverythingBelow(op2);
    });


    let buttonAdd = document.getElementById("addOption")
    buttonAdd.addEventListener("click",function(){
        
        let count = getIdFromInputs();
        if (count <100){
            count++;
            
            /*declarar, add atributos y texto a la label  */
            let newOptionLabel = document.createElement("label");
            newOptionLabel.setAttribute("for",count);
            newOptionLabel.innerHTML="Opcion "+count;
        
            /*declarar y add atributos al input */
            let newOptionInput = document.createElement("input");
            newOptionInput.setAttribute("type","text");
            newOptionInput.setAttribute("id","option"+count);
            newOptionInput.setAttribute("name","option"+count);
        
            createOption(newOptionLabel,newOptionInput,parentElem)
            toggleButtonDelete();
            if (count >99) {
                let disButton = document.getElementById("addOption")
                disButton.disabled=true;
            }
        }
        
        
        
    })

    
    let quitOp =document.getElementById("quitOption")
    
    quitOp.addEventListener("click", function(){
        toggleButtonDelete();
        let idInput = getIdFromInputs();
        if(idInput>2){
            let numLabel = getLengthLabels();
            deleteLabel(numLabel);
        }
        deleteLastOption();
        toggleButtonDelete();
        
        
    })
    let endDateInput = document.getElementById("endDate");
    endDateInput.disabled = true;

    $('#startDate').on('change', function(){
        // habilitar el endDate si el startDate esta completado
        var minimum = $('#startDate').val();
            
        $('#endDate').attr('min',minimum).val();

        let endDateInput = document.getElementById("endDate");
        endDateInput.disabled = false;
        if($('#endDate').val() != ''){
            endDateInput.value = null
        }
    });
    let inp = document.getElementsByTagName("input");
    let subm = inp[inp.length-1];
    subm.addEventListener("click",function(){
        if(!$('#startDate').val() && !$('#endDate').val()){
            alert("Primero rellena los campos de las fechas")
        }else{
            console.log(newMin)
            $('#startDate').change(end);
        }
    });
      
    

});

function getIdFromInputs() {
    let inputs=document.getElementsByTagName("input")
    /*es -4 el valor siguiente porque el ultimo y el antepenultimo son type input, pero no son los que nos interesan*/
    let lastInput =inputs[(inputs.length-4)]
    let attr = lastInput.getAttribute("id")
    let slicedAttr = attr.slice(6,attr.length);
    let count = parseInt(slicedAttr)
    return count;
}

function getLengthLabels() {
    let labels=document.getElementsByTagName("label")
    let lastLabel =labels[(labels.length-1)]
    return lastLabel;
}

function deleteLabel(lastLabel){
    lastLabel.parentElement.removeChild(lastLabel);
}

function createOption(optionLabel, optionInput,parent) {
    parent.appendChild(optionLabel);
    parent.appendChild(optionInput);

    // add un event listener cuando se crea la opcion
    optionInput.addEventListener("click", function () {
        deleteEverythingBelow(optionInput);
    });

    var scroller = document.getElementsByClassName('pc_buttons')[0];
    scroller.scrollIntoView();
}

function toggleButtonDelete() {
    
    let count = getIdFromInputs();
    let quitOp =document.getElementById("quitOption")
    if(count >2){
        quitOp.style.display="block"
        
    }else{
        quitOp.style.display="none"
    }
}

function deleteLastOption(){
    let count = getIdFromInputs();
    if(count >2){
        
        let removedElem= document.getElementById("option"+count);
        removedElem.parentElement.removeChild(removedElem);
    }
}


function deleteEverythingBelow(clickedInput) {
    let clickedId = clickedInput.id;
    //el match tiene dentro una regExp que es para detectar los digitos de dentro del id seleccionado y el || es para que pille por valor por defecto 1
    let matchResult = clickedId.match(/\D(\d+)/);
    // si tiene de length 2 significa que tiene numeros
    let count = matchResult && matchResult.length >= 2 ? parseInt(matchResult[1]) : 1;


    // borrar todos los inputs abajo del clickado
    if (count>=2){
        for (let i = count + 1; i <= 100; i++) {
            let inputToRemove = document.getElementById("option" + i);
            
            if (inputToRemove) {
                let numLabel = getLengthLabels();
                deleteLabel(numLabel);
                inputToRemove.parentElement.removeChild(inputToRemove);
            }
        }
    }else{
        for (let i = 2 +1; i <= 100; i++) {
            let inputToRemove = document.getElementById("option" + i);
            if (inputToRemove) {
                let numLabel = getLengthLabels();
                deleteLabel(numLabel);
                inputToRemove.parentElement.removeChild(inputToRemove);
            }
        }
    }
    toggleButtonDelete();
}


