function check(){
	if(frm.pa.value!=frm.cpa.value){
		frm.cpa.setCustomValidity("Password Not Matches");
		return false;
	}
	else{
		if(frm.pa.value.length<8){
			frm.cpa.setCustomValidity("Password Too Small Must be Greater than 8 Characters");
			return false;
		}
		else{
		frm.cpa.setCustomValidity("");
		return true;
		}
	}
	
}
function ch(){
    
    var pat = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
    
    if(pat.test(frm.name.value)){
        frm.name.setCustomValidity("Special Characters in name are not allowed");
        return false;
        
    }
    
    if(frm.name.value.trim()==''){
        frm.name.setCustomValidity("Extra space in Name");
        return false;
    }
    else{
         frm.name.setCustomValidity("");
        return true;  
    } 
    
}
function ch1(){
    
    if(frm.uname.value.trim()==''){
        frm.uname.setCustomValidity("Extra space in UserName");
        return false;
    }
    else{
         frm.uname.setCustomValidity("");
        return true;  
    }
  
    
    
}