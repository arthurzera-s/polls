<template>
    <div>
        <table class="table table-dark table-hover">
            <thead>
            <tr>
                <th scope="col">#ID</th>
                <th scope="col">Descrição da enquete</th>
                <th scope="col" v-if="stats">Views</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td scope="row">{{ enquete ? enquete.poll_id : '' }}</td>
                <td v-if="!update">{{ enquete ? enquete.poll_description : '' }}</td>
                <td v-if="update"><input-component v-model="enquete.poll_description"></input-component></td>
                <td v-if="stats">{{ views }}</td>
                <td><button type="button" class="btn btn-danger" @click="excluirEnquete(enquete.poll_id)">Excluir enquete</button></td>
                <td><button type="button" class="btn btn-info" @click="editarEnquete()" v-if="!update">Editar</button></td>
                <td><button type="button" class="btn btn-info" @click="exibirStats(enquete.poll_id)">Stats</button></td>
                <td><button type="button" class="btn btn-success" @click="salvarEdicao(enquete.poll_id)" v-if="update">Salvar</button></td>
            </tr>
            </tbody>
        </table>
        <table class="table table-dark table-hover">
            <thead>
            <tr>
                <th scope="col">#ID</th>
                <th scope="col">Opção</th>
                <th scope="col" v-if="stats">Votos</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(option, index) in options" :key="option.option_id">
                <td scope="row">{{ option ? option.option_id : '' }}</td>
                <td>{{ option ? option.option_description : '' }}</td>
                <td v-if="stats">{{votes[index]['qty']}}</td>
                <td></td>
                <td></td>
                <td><button type="button" class="btn btn-success" @click="votarNaOpcao(enquete.poll_id, option.option_id)">Votar</button></td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
    data() {
      return {
        enquete: null,
        options: [],
        stats: false,
        views: null,
        votes: {},
        poll_description: '',
        update: false,
      }
    },
    created() {
      const id = this.getIdFromUrl();
      this.loadEnquete(id);
    },
    methods: {
      getIdFromUrl() {
        const url = window.location.href;
        const match = url.match(/\/enquete\/(\d+)/);
        if (match) {
          return match[1];
        }
        return null;
      },
      loadEnquete(id) {
        fetch(`/api/poll/${id}`)
          .then(response => {
            if(!response.ok){
                alert("Enquete não encontrada!")
                window.location.href = '/todas-enquetes'
            }
            return response.json()
          })
          .then(data => {
            this.enquete = data;
            this.options = data.options;
          })
          .catch(error => {
          });
      },
      votarNaOpcao(enquete, opcao){
            const data ={
                option_id: opcao,
            }
            fetch(`/api/poll/${enquete}/vote`,{
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                if (response.status == 200) {
                    if(this.stats){
                        this.exibirStats(enquete)
                    }
                }
                else{
                    alert('Ocorreu um erro ao tentar registrar seu voto!')
                }
            })
        },
        excluirEnquete(id){
            fetch(`/api/poll/${id}`,{
                method: 'DELETE',
            })
            .then(response => {
                if (response.status == 200) {
                    alert("Enquete deletada com sucesso!")
                    window.location.href = '/todas-enquetes'
                }
                else{
                    alert('Ocorreu um erro ao tentar deletar a enquete!')
                }
            })
        },
        exibirStats(id){
            fetch(`/api/poll/${id}/stats`)
            .then(response => response.json())
            .then(data => {
                this.stats = true
                this.views = data.views
                this.votes = data.votes
            })
            .catch(error => {
                console.error('Erro ao buscar estatísticas:', error);
            });
        },
        editarEnquete(){
            this.update = true
        },
        salvarEdicao(id){
            const data = {
                poll_description: this.enquete.poll_description
            }
            fetch(`/api/poll/${id}`,{
                method: "PUT",
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                if(response.status == 200){
                    this.update = false
                }
            })
        }
    }
  }
</script>

