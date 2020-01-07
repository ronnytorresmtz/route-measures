<template>
    <!-- <panel-item :field="field" /> -->
    <!-- <div v-html="field" /> -->
    <div class="flex border-b border-40">
        <div class="w-1/4 py-4">
            <h4 class="font-normal text-80" v-html="field.name"></h4>
        </div>
        <div class="w-3/4 py-4 break-words">
            <div v-html="field.value"></div>
        </div>
    </div>
</template>

<script>
export default {
    
    props: ['resource', 'resourceName', 'resourceId', 'field'],

    created() {
        if (this.field.response['code'] != 200) {
            this.$toasted.show(this.field.response['message'] , { type: 'error' })
        } else {
            this.field.value = this.field.distance['kms'] + ' Kilometers (' + 
                        this.field.distance['miles'] + ' Miles) <br><br> ' + 
                        this.field.duration['hours'] + ' Hours ' +
                        this.field.duration['minutes'] + ' Minutes';
        }
    },
}
</script>
