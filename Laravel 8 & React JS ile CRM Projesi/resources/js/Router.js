import React from 'react';
import { Route , Switch} from 'react-router-dom';
import PrivateRoute from './PrivateRoute';
/* Sayfalar */
import FrontIndex from './Views/Index';
import FrontLogin from './Views/Login';
import FrontRegister from './Views/Register';
/* Ürünler */
import ProductIndex from './Views/Product/index';
import ProductCreate from './Views/Product/create';
import ProductEdit from './Views/Product/edit';
/* Kategoriler */
import CategoryIndex from './Views/Category/index';
import CategoryCreate from './Views/Category/create';
import CategoryEdit from './Views/Category/edit';
/* Müşteriler */
import CustomerIndex from './Views/Customer/index';
import CustomerCreate from './Views/Customer/create';
import CustomerEdit from './Views/Customer/edit';


const Main = () => (
    <Switch>
        <PrivateRoute exact path="/" component={FrontIndex} />
        <Route path="/login" component={FrontLogin} />
        <Route path="/register" component={FrontRegister} />

        <PrivateRoute exact path="/urunler" component={ProductIndex} />
        <PrivateRoute  path="/urunler/ekle" component={ProductCreate} />
        <PrivateRoute  path="/urunler/duzenle/:id" component={ProductEdit} />

        <PrivateRoute exact path="/kategoriler" component={CategoryIndex} />
        <PrivateRoute  path="/kategori/ekle" component={CategoryCreate} />
        <PrivateRoute  path="/kategori/duzenle/:id" component={CategoryEdit} />

        <PrivateRoute exact path="/musteriler" component={CustomerIndex} />
        <PrivateRoute  path="/musteri/ekle" component={CustomerCreate} />
        <PrivateRoute  path="/musteri/duzenle/:id" component={CustomerEdit} />

       

    </Switch>
);
export default Main;