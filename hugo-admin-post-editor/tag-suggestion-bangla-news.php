<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Autocomplete Tags</title>
  <style>
    .autocomplete {
      position: relative;
      display: inline-block;
    }

    
    .autocomplete-items {
      position: absolute;
      border: 0.5px solid #d4d4d4;
      border-top: none;
      z-index: 99;
      top: 100%;
      left: 0;
      right: 0;
    }

    .autocomplete-item {
      padding: 1px;
      cursor: pointer;
      background-color: #f1f1f1;
    }

    .autocomplete-item:hover {
      background-color: #e9e9e9;
    }
  </style>
</head>
<body>

<div class="autocomplete">
  <label for="post-tags">Tags (comma-separated):<red></label><label for="post-tags">Tags (comma-separated):<red></label>
  <!--input id="post-tags" type="text" placeholder="Type here"-->
  <input type="text" id="post-tags" size="122px" value="<?php echo $tags; ?>" placeholder="At least add main tags i.e pornstar, video, photos, indian" required>
  <div id="autocompleteList" class="autocomplete-items"></div>
</div>

<script>
  // Predefined tags
  const tags = ['politics', 'kolkata', 'west-bengal', 'india', 'world',
                'cricket', 'sports', 'business', 'entertainment', 'health',
				'lifstyle', 'Photos', 'horoscope', 'jobs', 'government-schemes', 'web-stories'];

  // Function to filter tags based on user input
  function autocomplete(input) {
    let matches = tags.filter(tag => tag.toLowerCase().includes(input.toLowerCase()));
    showAutocomplete(matches);
  }

  // Function to display autocomplete suggestions
  function showAutocomplete(matches) {
    const autocompleteList = document.getElementById('autocompleteList');
    autocompleteList.innerHTML = '';

    matches.forEach(match => {
      const item = document.createElement('div');
      item.classList.add('autocomplete-item');
      item.textContent = match;
      item.addEventListener('click', () => {
        document.getElementById('post-tags').value = match;
        autocompleteList.innerHTML = '';
      });
      autocompleteList.appendChild(item);
    });
  }

  // Event listener for input field
  document.getElementById('post-tags').addEventListener('input', function() {
    autocomplete(this.value);
  });
  
  document.getElementById('post-tags').addEventListener('click', function() {
    autocomplete(this.value);
  });
</script>

</body>
</html>
