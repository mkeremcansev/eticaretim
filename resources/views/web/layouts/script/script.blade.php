   <script>
        let words = [
            @foreach ($categories as $r)
                @foreach ($r->getAllCategoriesCollection as $c)
                    "{{ $c->title }}".replace(/&amp;/g, '&'),
                @endforeach
            @endforeach
        ];
        let i = 0;
        let timer;

        function typingEffect() {
        let word = words[i].split("");
        const loopTyping = function() {
            if (word.length > 0) {
            let text = document.getElementById('search_input_typing');
            text.setAttribute('placeholder', text.getAttribute('placeholder') + word.shift());
            } else {
                setTimeout(function(){
                    deletingEffect();
                }, 1500)
            
            return false;
            };
            timer = setTimeout(loopTyping, 50);
        };
        loopTyping();
        };

        function deletingEffect() {
        let word = words[i].split("");
        var loopDeleting = function() {
            if (word.length > 0) {
            word.pop();
            document.getElementById('search_input_typing').setAttribute('placeholder', word.join(""));
            } else {
            if (words.length > (i + 1)) {
                i++;
            } else {
                i = 0;
            };
            typingEffect();
                return false;
            };
            timer = setTimeout(loopDeleting, 50);
        };
        loopDeleting();
        };
        typingEffect();
   </script>