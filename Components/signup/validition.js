function KiemtraBatBuocDangNhap() {
    var thongbao = document.getElementById('thongbao');

    if (frmSignIn.name.value == "" || frmSignIn.password.value == "") {
        frmSignIn.name.style.border = "solid 2px red";
        frmSignIn.password.style.border = "solid 2px red";
        thongbao.style.display = "block";
        thongbao.innerHTML = "Need to enter enough information";
        return false;
    } else {
        thongbao.style.display = "none";
        return true;
    }
}

function KiemtraBatBuocDangKy(){
    var thongbao1 = document.getElementById('thongbao1');

    if (frmSignUp.user.value == "" || frmSignUp.password2.value == "" || frmSignUp.email2.value == "") {
        frmSignUp.user.style.border = "solid 2px red";
        frmSignUp.password2.style.border = "solid 2px red";
        frmSignUp.repeat_password.style.border = "solid 2px red";
        frmSignUp.email2.style.border = "solid 2px red";
        thongbao1.style.display = "block";
        thongbao1.innerHTML = "Need to enter enough information";
        return false;
    } else {
        thongbao1.style.display = "none";
        
        return true;
    }
}

function KiemTraHopLe() {
    return KiemtraBatBuocDangNhap();
}

function SignUp(){
    return KiemtraBatBuocDangKy();
}