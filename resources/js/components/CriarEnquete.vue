<template>
    <div>
        <input-component id="descricao" title="Descrição" placeholder="Digite a descrição da enquete" v-model="description"></input-component>
        <div v-for="(input, index) in inputs" :key="index">
                <input-component :id="input.id" :title="input.title" :placeholder="input.placeholder" v-model="input.value"></input-component>
        </div>
        <button type="button" class="btn btn-secondary" @click="addInput">Adicionar opção</button>
        <button type="button" class="btn btn-primary" @click="salvar()">Cadastrar</button>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                description: '',
                inputs: [
                    { title: 'Opção 1', value: '', id: 'opcao1', placeholder: 'Digite a opção 1'},
                ],
            }
        },
        methods: {
            addInput() {
                this.inputs.push({ title: `Opção ${this.inputs.length + 1}`, value: '',
                    id: `opcao1${this.inputs.length + 1}` + 1, placeholder: `Digite a opção ${this.inputs.length + 1}`});
            },
            salvar(){
                const data = {
                    poll_description: this.description,
                    options: this.inputs.map(input => input.value),
                }
                fetch(`/api/poll`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => {
                    if (response.status === 201) {
                        alert("Enquete cadastrada com sucesso!")

                        return response.json()
                    }
                    else{
                        alert('Ocorreu um erro ao tentar cadastrar a enquete!')
                    }
                })
                .then(data => {
                    window.location.href = `/enquete/${data.poll_id}`
                })
            }
        },
    }
</script>
