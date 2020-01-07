<template>
    <span v-html="field.value"></span>
</template>

<script>
export default {
    
    props: ['resourceName', 'field'],

    created() {
        if (this.field.response['code'] != 200) {
            this.$toasted.show(this.field.response['message'] , { type: 'error' })
        } else {
            this.field.value = this.field.distance['kms'] + ' Kilometers (' + 
                            this.field.distance['miles'] + ' Miles) <br> ' + 
                            this.field.duration['hours'] + ' Hours ' +
                            this.field.duration['minutes'] + ' Minutes';
        }
    },
}
</script>
