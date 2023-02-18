<template>
    <div class="mb-3">
        <label :for="id" class="form-label">{{ title }}</label>
        <input type="input" class="form-control" :id="id" :placeholder="placeholder" :value="value" @input="$emit('input', $event.target.value)">
    </div>
</template>

<script>
    export default {
        props:['id', 'title', 'placeholder', 'value']
    }
</script>
