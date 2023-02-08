<template lang="">
    <div class="navbar bg-base-100 bg-opacity-25 backdrop-blur-md sticky top-0 z-10">
        <div class="navbar-start px-4 ">
            <div class="dropdown">
            <label tabindex="0" class="btn btn-ghost lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" /></svg>
            </label>
            <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-max">
                <Link :href="route('beranda')">
                    <li>
                        <a>Beranda</a>
                    </li>
                </Link>
                <li tabindex="0">
                <a class="justify-between">
                    Menu
                    <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z"/></svg>
                </a>
                <ul class="p-2">
                    <menu-vue :role="role" :auth="auth" :key="$inertia.page.component"></menu-vue>
                </ul>
                </li>
                <li><a>Item 3</a></li>
            </ul>
            </div>
            <div class="">
                <img class="h-[2rem]" :src="MasterPerusahaan.logo" alt="">
            </div>
        </div>
        <div class="navbar-center hidden lg:flex">
            <ul class="menu menu-horizontal px-1">
            <Link as="li" :href="route('beranda')"><a>Beranda</a></Link>
            <li tabindex="0">
                <a>
                Menu
                <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z"/></svg>
                </a>
                <ul class="p-2 bg-white">
                    <menu-vue :role="role" :auth="auth" :key="$inertia.page.component"></menu-vue>
                </ul>
            </li>
            <li tabindex="0">
                <a>
                Pengaturan
                <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z"/></svg>
                </a>
                <ul class="p-2 bg-white">
                    <pengaturan :key="$inertia.page.component"></pengaturan>
                </ul>
            </li>
            </ul>
        </div>
        <div class="navbar-end z-0">
            <div class="dropdown dropdown-end">
                <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full" v-if="foto">
                        <img :src="foto" />
                    </div>
                    <div class="avatar placeholder" v-else>
                        <div class="bg-neutral-focus text-neutral-content rounded-full w-8">
                            <span class="text-xs">{{auth.user.nama.substring(0,1)}}</span>
                        </div>
                    </div>
                </label>
                <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
                    <Link :href="route('logout.store')" method="post" as="li" v-if="login"><a>Logout</a></Link>
                </ul>
            </div>
        </div>
    </div>
    <div class="p-4">
        <slot></slot>
    </div>
</template>
<script>
import MenuVue from '../Components/menu.vue'
import Pengaturan from '../Components/pengaturan.vue'
import { Link } from '@inertiajs/inertia-vue3';
export default {
    props: {
        MasterPerusahaan: Object,
        login: Boolean,
        role: Object,
        auth: Object,
    },
    components: {
        MenuVue,
        Link,
        Pengaturan,
    },
    data() {
        return {
        }
    },
    computed: {
        foto() {
            var url = this.auth.user.developer ? this.auth.user.developer.logo : (this.auth.user.agen ? this.auth.user.agen.foto : null)
            var status_url = url ? url.search('http') : 0
            if (status_url < 0) {
                url = `${window.location.origin}/${url}`
            }
            return url
        }
    }
}
</script>
<style lang="">
    
</style>