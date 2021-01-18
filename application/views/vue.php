<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>

    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
</head>
<body>


<div id="demo">
    <p>{{message ? message : "no content"}}</p>
    <input v-model="message">
</div>



<script>
    var demo = new Vue({
        el: '#demo',
        data: {
            message: 'Hello, Singree!'
        }
    })
</script>


</body>
</html>