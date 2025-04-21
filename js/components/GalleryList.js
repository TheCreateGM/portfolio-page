// Requires React and ReactDOM CDNs loaded BEFORE this script

// Simple React component to fetch and display gallery links
function GalleryList({ assetBaseUrl }) {
    const [galleryItems, setGalleryItems] = React.useState([]);
    const [loading, setLoading] = React.useState(true);
    const [error, setError] = React.useState(null);

    React.useEffect(() => {
        fetch(assetBaseUrl + 'data/gallery.json')
            .then(response => {
                 if (!response.ok) {
                     throw new Error(`HTTP error! status: ${response.status}`);
                 }
                return response.json();
            })
            .then(data => {
                setGalleryItems(data || []); // Use empty array if response is empty
                setLoading(false);
            })
            .catch(err => {
                console.error("Failed to fetch gallery data:", err);
                setError("Could not load gallery information.");
                setLoading(false);
            });
    }, [assetBaseUrl]);

     if (loading) {
        // Render loading state within a column
        return React.createElement('div', { className: 'columns is-multiline is-centered' },
            React.createElement('div', { className: 'column is-full has-text-centered' },
                React.createElement('p', { className: 'notification is-info is-light' }, 'Loading gallery...')
            )
        );
    }

    if (error) {
         // Render error state within a column
         return React.createElement('div', { className: 'columns is-multiline is-centered' },
             React.createElement('div', { className: 'column is-full has-text-centered' },
                 React.createElement('p', { className: 'notification is-warning' }, error)
             )
         );
    }

    if (galleryItems.length === 0) {
        // Render empty state within a column
        return React.createElement('div', { className: 'columns is-multiline is-centered' },
             React.createElement('div', { className: 'column is-full has-text-centered' },
                 React.createElement('p', { className: 'notification is-info' }, 'No gallery items available.')
             )
        );
    }

    // Render the columns container and then map over gallery items, wrapping each in a column
    return React.createElement('div', { className: 'columns is-multiline is-centered' }, // This is the container
        galleryItems.map((item, index) =>
            React.createElement('div', { key: index, className: 'column is-one-third' }, // Each item is a column
                React.createElement('div', { className: 'card gallery-item' },
                     item.image && React.createElement('div', { className: 'card-image' },
                        React.createElement('figure', { className: 'image is-16by9' },
                            item.link ?
                            React.createElement('a', { href: item.link },
                                React.createElement('img', {
                                    src: assetBaseUrl + item.image,
                                    alt: item.category || 'Gallery Item'
                                })
                            ) :
                            React.createElement('img', {
                                src: assetBaseUrl + item.image,
                                alt: item.category || 'Gallery Item'
                            })
                        )
                    ),
                    React.createElement('div', { className: 'card-content has-text-centered' },
                         React.createElement('p', { className: 'title is-5' }, item.category || 'Gallery')
                    ),
                     item.link && React.createElement('footer', { className: 'card-footer' },
                         React.createElement('a', { href: item.link, className: 'card-footer-item' },
                            React.createElement('span', { className: 'icon is-small' },
                                React.createElement('i', { className: 'fas fa-images' })
                            ),
                            ' View Gallery'
                         )
                     )
                )
            )
        )
    );
}