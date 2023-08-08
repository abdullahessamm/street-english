<template>
    <div class="app">
        <h3>{{ msg }}</h3>
        <div>
            <Button label="submit" />
        </div>
    </div>
</template>

<script>
import Button from 'primevue/button'

export default {
    name: "App",
    data: () => ({
        msg: "Another vue app created!"
    }), // end of data

    components: [
        Button,
    ],
}
</script>