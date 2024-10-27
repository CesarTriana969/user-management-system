import './bootstrap';
import { createApp } from 'vue';
import store from './store';

import NavbarComponent from './components/NavbarComponent.vue';
import Users from './pages/users/Index.vue';
import CreateUser from './pages/users/Create.vue';
import EditUser from './pages/users/Edit.vue';
import Roles from './pages/roles/Index.vue';
import CreateRole from './pages/roles/Create.vue';
import Dashboard from './pages/dashboard/Index.vue';
import Auth from './pages/principal/auth/Index.vue';

const createMyApp = () => {
    const app = createApp({});

    app.component('navbar-component', NavbarComponent);

    /***** Users *****/
    app.component('user-component', Users);
    app.component('create-user-component', CreateUser);
    app.component('edit-user-component', EditUser);

    /***** Roles *****/
    app.component('role-component', Roles);
    app.component('create-role-component', CreateRole);

    app.component('dashboard-component', Dashboard);

    /***** Principal *****/
    app.component('auth-component', Auth);

    app.use(store);

    return app;
};

createMyApp().mount('#app');