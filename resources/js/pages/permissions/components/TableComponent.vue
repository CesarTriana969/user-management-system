<template>
    <table class="w-full text-sm text-left text-gray-500">
           <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
               <tr>
                   <th scope="col" class="p-4">
                       <div class="flex items-center">
                           <input id="checkbox-all-search" 
                               type="checkbox" 
                               class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 focus:ring-2 "
                               v-model="AllCheck"
                           >
                           <label for="checkbox-all-search" class="sr-only">checkbox</label>
                       </div>
                   </th>
                   <th scope="col" class="py-3 px-3">
                       ID
                   </th>
                   <th scope="col" class="py-3 px-6">
                       Nombre
                   </th>
               
                   <th scope="col" class="py-3 px-6">
                   </th>
               </tr>
           </thead>
           <tbody>
               <tr class="bg-white border-b hover:bg-gray-50 "
                   v-for="user in users" :key="user.id"
               >
                  <DataTableComponent 
                       :user="user"
                       @checkbox="checkDataUpdate"
                       :statusC="AllCheck"
                       v-if="!isLoading"
                   ></DataTableComponent>
   
                  
               </tr>
               <tr v-if="isLoading">
                
                   <td>
                       <div role="status" class="max-w-sm animate-pulse " >
                           <div class="animate-pulse">
                               <div class="h-4 bg-gray-200 mt-3 mb-6 rounded"></div>
                               <div class="h-4 bg-gray-300 mb-6 rounded"></div>
                               <div class="h-4 bg-gray-200 mb-6 rounded"></div>
                               <div class="h-4 bg-gray-300 mb-6 rounded"></div>
                               <div class="h-4 bg-gray-200 mb-6 rounded"></div>
                           </div>
                       </div>
                   </td>
                   <td>
                       <div role="status" class="max-w-sm animate-pulse " >
                           <div class="animate-pulse">
                               <div class="h-4 bg-gray-200 mt-3 mb-6 rounded"></div>
                               <div class="h-4 bg-gray-300 mb-6 rounded"></div>
                               <div class="h-4 bg-gray-200 mb-6 rounded"></div>
                               <div class="h-4 bg-gray-300 mb-6 rounded"></div>
                               <div class="h-4 bg-gray-200 mb-6 rounded"></div>
                           </div>
                       </div>
                   </td>
                   <td>
                       <div role="status" class="max-w-sm animate-pulse " >
                           <div class="animate-pulse">
                               <div class="h-4 bg-gray-200 mt-3 mb-6 rounded"></div>
                               <div class="h-4 bg-gray-300 mb-6 rounded"></div>
                               <div class="h-4 bg-gray-200 mb-6 rounded"></div>
                               <div class="h-4 bg-gray-300 mb-6 rounded"></div>
                               <div class="h-4 bg-gray-200 mb-6 rounded"></div>
                           </div>
                       </div>
                   </td>
                   <td>
                       <div role="status" class="max-w-sm animate-pulse " >
                           <div class="animate-pulse">
                               <div class="h-4 bg-gray-200 mt-3 mb-6 rounded"></div>
                               <div class="h-4 bg-gray-300 mb-6 rounded"></div>
                               <div class="h-4 bg-gray-200 mb-6 rounded"></div>
                               <div class="h-4 bg-gray-300 mb-6 rounded"></div>
                               <div class="h-4 bg-gray-200 mb-6 rounded"></div>
                           </div>
                       </div>
                   </td>
                   <td>
                       <div role="status" class="max-w-sm animate-pulse " >
                           <div class="animate-pulse">
                               <div class="h-4 bg-gray-200 mt-3 mb-6 rounded"></div>
                               <div class="h-4 bg-gray-300 mb-6 rounded"></div>
                               <div class="h-4 bg-gray-200 mb-6 rounded"></div>
                               <div class="h-4 bg-gray-300 mb-6 rounded"></div>
                               <div class="h-4 bg-gray-200 mb-6 rounded"></div>
                           </div>
                       </div>
                   </td>
                   <td>
                       <div role="status" class="max-w-sm animate-pulse " >
                           <div class="animate-pulse">
                               <div class="h-4 bg-gray-200 mt-3 mb-6 rounded"></div>
                               <div class="h-4 bg-gray-300 mb-6 rounded"></div>
                               <div class="h-4 bg-gray-200 mb-6 rounded"></div>
                               <div class="h-4 bg-gray-300 mb-6 rounded"></div>
                               <div class="h-4 bg-gray-200 mb-6 rounded"></div>
                           </div>
                       </div>
                   </td>
                   <td>
                       <div role="status" class="max-w-sm animate-pulse " >
                           <div class="animate-pulse">
                               <div class="h-4 bg-gray-200 mt-3 mb-6 rounded"></div>
                               <div class="h-4 bg-gray-300 mb-6 rounded"></div>
                               <div class="h-4 bg-gray-200 mb-6 rounded"></div>
                               <div class="h-4 bg-gray-300 mb-6 rounded"></div>
                               <div class="h-4 bg-gray-200 mb-6 rounded"></div>
                           </div>
                       </div>
                   </td>
                   <td>
                       <div role="status" class="max-w-sm animate-pulse " >
                           <div class="animate-pulse">
                               <div class="h-4 bg-gray-200 mt-3 mb-6 rounded"></div>
                               <div class="h-4 bg-gray-300 mb-6 rounded"></div>
                               <div class="h-4 bg-gray-200 mb-6 rounded"></div>
                               <div class="h-4 bg-gray-300 mb-6 rounded"></div>
                               <div class="h-4 bg-gray-200 mb-6 rounded"></div>
                           </div>
                       </div>
                   </td>
                   <td>
                       <div role="status" class="max-w-sm animate-pulse " >
                           <div class="animate-pulse">
                               <div class="h-4 bg-gray-200 mt-3 mb-6 rounded"></div>
                               <div class="h-4 bg-gray-300 mb-6 rounded"></div>
                               <div class="h-4 bg-gray-200 mb-6 rounded"></div>
                               <div class="h-4 bg-gray-300 mb-6 rounded"></div>
                               <div class="h-4 bg-gray-200 mb-6 rounded"></div>
                           </div>
                       </div>
                   </td>
                   
               </tr>
              
           </tbody>
       </table>
   </template>
   
   <script>
   import DataTableComponent from './DataTableComponent.vue';
   export default {
       components: { DataTableComponent },
       props: {
           users: {
               type: Object
           },
           emptyCheck:{
               type: Boolean
           },
           isLoading:{
               type: Boolean
           }
       },
       data(){
           return{
               checkData: [],
               AllCheck: false
           }
       },
       methods:{
           checkDataUpdate(data){
               if(data.status === false){
                   let exist = this.checkData.find(i => i == data.id)
                   if(!exist){
                       this.checkData.push(data.id)
                   }
               }else{
                  this.checkData = this.checkData.filter(item => item !== data.id)
               }
               this.$emit('checkbox', this.checkData, data.enabled)
           },
           allChecked(){
               this.AllCheck = !this.AllCheck
           }
       },
       watch:{
           emptyCheck(){
               this.AllCheck = false
           }
       }
     
      
   }
   </script>
   
   <style>
   
   </style>