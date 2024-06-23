document.getElementById('fetchButton').addEventListener('click', async () => {
    const url = document.getElementById('urlInput').value;
    if (!url) {
        alert('Please enter a URL');
        return;
    }

    try {
        const proxyUrl = `https://script.google.com/macros/s/AKfycbytIJNJ-x8iGHHN8AgxoVa60Z1HWJorMiOyPyA4eUIYbAsZdbpMJj8eJErevCVviJdTNQ/exec?url=${encodeURIComponent(url)}`;
        const response = await fetch(proxyUrl);
        const html = await response.text();

        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        const reader = new Readability(doc);
        const article = reader.parse();

        const title = doc.title || article.title;

        // Function to remove HTML tags
        function stripHTML(html) {
            var tempDiv = document.createElement('div');
            tempDiv.innerHTML = html;
            return tempDiv.textContent || tempDiv.innerText || '';
        }

        const content = stripHTML(article.content);

        document.getElementById('titleText').value = title;
        document.getElementById('contentText').value = content;
    } catch (error) {
        console.error('Error fetching or extracting content:', error);
        alert('Failed to fetch or extract content. Check the console for details.');
    }
});

document.getElementById('copyButton').addEventListener('click', () => {
    const title = document.getElementById('titleText').value;
    const content = document.getElementById('contentText').value;
    const combinedText = `Title: ${title}\n\nContent:\n${content}`;

    navigator.clipboard.writeText(combinedText).then(() => {
        alert('Content copied to clipboard');
    }).catch(err => {
        console.error('Error copying to clipboard:', err);
        alert('Failed to copy content to clipboard. Check the console for details.');
    });
});

