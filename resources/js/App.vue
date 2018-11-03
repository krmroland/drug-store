<template>
    <div>
       <header class="header"></header>
       <div class="container-fluid">
          <div class="row">
            <div class="col-md-2">
                <aside id="sidebar">
                  <router-link to="/home" exact>
                      <icon-dashboard></icon-dashboard>
                      Home
                  </router-link>
                  <router-link to="/sales" exact>
                    <icon-cart></icon-cart>
                    Sales 
                </router-link>
                <router-link to="/drugs" >
                    <icon-store></icon-store>
                    Drugs 
                </router-link>
                <router-link to="/reports" exact>
                    <icon-bar-graph></icon-bar-graph>
                    Reports
                </router-link>
            </aside>
        </div>
        <div class="col-md-10">
          <main>
             <transition  leave-active-class="animated fadeOut"  >
                <div v-if="isMakingAjax" class="overlay d-flex align-items-center justify-content-center">
                    <div class="contents">
                        <i class="mr-2 loader">
                           <icon-puff></icon-puff>   
                       </i>
                   </div>

               </div>
           </transition>
           <router-view></router-view>
       </main>
   </div>
</div>

</div>
</div>
</template>
<script>
    export default {
        data(){
            return {
                isMakingAjax:false
            }
        },
        created() {
        // Add a request interceptor
        window.axios.interceptors.request.use(config =>{
            this.isMakingAjax=true
            return config;
        });

        // Add a response interceptor
        window.axios.interceptors.response.use(response=> {
             this.isMakingAjax=false
            return response;
        },response=>{
             this.isMakingAjax=false
        
            return Promise.reject(response);
        });
    }
};
</script>