<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $story->name }}</title>
    @vite('resources/css/app.css')
</head>

<body class="antialiased">
    <div id="stroyblok-content-type">
        <x-dynamic-component :component="$story->content['component']" :blok="$story->content" class="mt-4" />
    </div>
    <script type="text/javascript" src="//app.storyblok.com/f/storyblok-v2-latest.js"></script>

    <script>
        const {
            StoryblokBridge
        } = window
        const storyblokInstance = new StoryblokBridge()


        const sendStory = async function(event) {
            const response = await fetch(
                'https://laravel-storyblok-realtime.test/_storyblok/', {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        // 'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: JSON.stringify(event)
                });
            let pageComponent = await response.text();
            document.getElementById("stroyblok-content-type").innerHTML = pageComponent
            storyblokInstance.enterEditmode()
            return pageComponent;
        }
        storyblokInstance.on(['input'], (event) => {
            // reload page if save or publish is clicked
            console.log(event)
            console.log(sendStory(event));
            //console.log(sendStory(event))




        })


        storyblokInstance.on(['published', 'change'], () => {
            // reload page if save or publish is clicked
            console.log("something")
            location.reload(true)
        })
    </script>

</body>

</html>
