
/**
 * Fonction de choix pour les checksbox du formulaire contact  
 * @returns {undefined}
 */ 

function cbChooser() {

    var cbCli   = $('.CB_CLI');
    var cbFour  = $('.CB_FOUR');
    var cbPrspt = $('.CB_PRSPT');

    cbPrspt.click(function () {
        cbCli.attr("checked", false);
        cbFour.attr("checked", false);
        }
    );

    cbCli.click(function () {
        cbPrspt.attr("checked", false);
        }
    );

    cbFour.click(function () {
        cbPrspt.attr("checked", false);
        }
    );
}


function formChooser(){
    //Listener pour click sur le bouton réinitialiser
   $('#clearForm').click(function(){
        $("#add_ent").hide();
        $("#add_prs").hide();
        $("#add_adr").hide();
        $("#add_tel_mail").hide();
        $("#btn_zone").hide();
            
   });
       
   
    var typeCtc = $("#typeCtc").val();
    
    console.log(typeCtc);
    
    switch (typeCtc){
        
         case "":
             
            $("#add_ent").hide();
            $("#add_prs").hide();
            $("#add_adr").hide();
            $("#add_tel_mail").hide();
            $("#btn_zone").hide();
            
            break;
        
        case "1":
            
            $("#add_ent").show();
            $("#add_prs").hide();
            $("#add_adr").show();
            $("#add_tel_mail").show();
            $("#btn_zone").show();
            
            break;
            
        case "2":
           
           $("#add_ent").hide();
           $("#add_prs").show();
           $("#add_adr").show();
           $("#add_tel_mail").show();
           $("#btn_zone").show();
 
           break;
           
     
       
    }
}

