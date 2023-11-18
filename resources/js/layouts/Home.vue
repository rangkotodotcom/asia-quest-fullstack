<template>
    <div class="min-h-full">
        <HomeNavbar />
        <main>
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                <router-view />
            </div>
        </main>
    </div>
</template>

<script>
import HomeNavbar from '../components/navbars/HomeNavbar.vue';




export default {
    components: {
        HomeNavbar,
    }
}

</script>