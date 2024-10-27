<template>
    <title-component :title="'Edit User - ' + user.name.charAt(0).toUpperCase() + user.name.slice(1) "
        :links="[
            { text: 'Users', href: '/system/users' },
            { text: 'Data', href: '/system/users' },
            { text: 'Edit', href: '#' }
        ]"
    ></title-component>

    <FormEditComponent :user="user"></FormEditComponent>
    <br/>
 </template>

 <script>

import FormEditComponent from './components/FormEditComponent.vue'
import CountEditComponent from './components/CountEditComponent.vue'
import ActionsEditComponent from './components/ActionsEditComponent.vue'
import TitleComponent from '@/components/TitleComponent.vue';

 export default {
    components: { FormEditComponent, CountEditComponent, ActionsEditComponent, TitleComponent },
    props: {
        user: {
            type: Object
        },
    },
    computed:{
        permissions() {
            return this.$store.state.permissions
        },
     },
    data() {
        return{
            account: true,
            information: false,
            schedule: false,
            alert: this.user.enabled
        }
    },

    methods: {
        block(information){
            this.alert = information
        },
        userHasPermission(permissionName) {
            return this.permissions.includes(permissionName);
        },
    },
}
 </script>