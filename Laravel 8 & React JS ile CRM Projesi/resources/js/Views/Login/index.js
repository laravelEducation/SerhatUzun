import { divide } from 'lodash';
import React from 'react';
import {Link} from 'react-router-dom';



const Login = () =>{
    return (
    <div className="login-register-container">

        <form class="form-signin">
            <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72"/>
            <h1 class="h3 mb-3 font-weight-normal">Giriş Yapın</h1>
            <label for="inputEmail" class="sr-only">Email Adresi</label>
            <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="" autofoc =""/>
            <label for="inputPassword" class="sr-only">Parola</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" required=""/>
            <div class="checkbox mb-3">
                <label>
                <input type="checkbox" value="remember-me"/> Beni Hatırla
                </label>
            </div >
           
            <button class="btn btn-lg btn-primary btn-block btn-cen " type="submit">Giriş Yap</button> <br></br>
             
            <Link className="mt-" style={{display:'block'}} to = "/register">Kayıt Ol</Link>
        
            
            <p class="mt-5 mb-3 text-muted">© 2017-2018</p>
            </form>

    </div>
         )


};

export default  Login;
