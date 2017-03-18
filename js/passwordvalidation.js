function val(){
if(frm.pass.value == "")
{
	alert("Enter the Password");
	frm.pass.focus(); 
	return false;
}
if((frm.pass.value).length < 8)
{
	alert("Password should be minimum 8 characters.");
	frm.pass.focus();
	return false;
}

if(frm.confirmpass.value == "")
{
	alert("Enter the Confirmation Password.");
	return false;
}
if(frm.confirmpass.value != frm.pass.value)
{
	alert("Passwords do not match.");
	return false;
}

return true;
}
