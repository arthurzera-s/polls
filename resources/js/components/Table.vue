<template>
    <table class="table table-dark table-hover">
        <thead>
        <tr>
            <th scope="col">#ID</th>
            <th scope="col" colspan="4">Descrição da enquete</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="enquete in enquetes" :key="enquete.poll_id" @click="getEnquete(enquete.poll_id)">
            <th scope="row" style="cursor:pointer">{{ enquete.poll_id }}</th>
            <td style="cursor:pointer">{{ enquete.poll_description}}</td>
        </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        data(){
            return{
                enquetes: []
            }
        },
        methods:{
            carregarEnquetes(){
                fetch('/api/poll')
                .then(response => response.json())
                .then(data => {
                    this.enquetes = data.polls;
                })
                .catch(error => {
                    console.error('Erro ao buscar enquetes:', error);
                });
            },
            getEnquete(id){
                window.location.href = `/enquete/${id}`
            }
        },
        mounted(){
            this.carregarEnquetes()
        }
    }
</script>

