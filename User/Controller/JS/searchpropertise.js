// controller/js/search.js

document.addEventListener('DOMContentLoaded', function () {
  const q = document.getElementById('q');
  const btn = document.getElementById('searchBtn');
  const searchResults = document.getElementById('searchResults');

  function updateLink() {
    const val = encodeURIComponent(q.value.trim());
    btn.href = val ? `../Controller/propertiesearch.php?q=${val}` : 'properties.php';

    searchResults.innerHTML = '';

    if (val) {
      fetch(`../Controller/propertiesearch.php?q=${val}`)
        .then(response => response.json())
        .then(data => {
          if (data && data.length > 0) {
            data.forEach(property => {
              const anchor = document.createElement('a');
              anchor.href = `viewdetails.php?id=${property.property_id}`;
              anchor.innerText = property.title;
              anchor.classList.add('search-result-item');
              searchResults.appendChild(anchor);
            });
          } else {
            searchResults.innerHTML = '<p>No properties found for your search.</p>';
          }
        })
        .catch(error => {
          console.error('Error fetching search results:', error);
        });
    }
  }

  q.addEventListener('input', updateLink);
  updateLink(); 
});
