/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    
    
function formChooser(){
    
   
    var typeCtc = $("#typeCtc").val();
  
    
    console.log(typeCtc);
    switch (typeCtc){
        
        
        case "1":
            
            $("#form_add_ent").show();
            $("#form_add_prs").hide();
            break;
            
        case "2":
           //$("#form_add_ent").css('z-index','1');
           $("#form_add_ent").hide();
           $("#form_add_prs").show();
           //$("#form_add_prs").css('z-index','200');
            break;
            
        case "0":
            
            $("#form_add_ent").hide();
            $("#form_add_prs").hide();  
            break;
        
    }
}
