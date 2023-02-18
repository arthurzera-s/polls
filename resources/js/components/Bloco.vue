<template>
    <div class="col-lg-6 col-xxl-4 mb-5" style="cursor: pointer;">
        <a :href="rota" style="text-decoration: none;">
            <div class="card bg-light border-0 h-100">
                <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4">{{ type }}</div>
                    <h2 class="fs-4 fw-bold">{{ example }}</h2>
                    <p class="mb-0"></p>

                </div>
            </div>
        </a>
    </div>
</template>

<script>
    export default {
        props: ['example', 'type', 'rota']
    }
</script>

