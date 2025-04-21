// Requires React and ReactDOM CDNs loaded BEFORE this script

// Simple React component to fetch and display social links
function SocialLinks({ assetBaseUrl }) {
    const [socialLinks, setSocialLinks] = React.useState([]);
    const [loading, setLoading] = React.useState(true);
    const [error, setError] = React.useState(null);

    React.useEffect(() => {
        fetch(assetBaseUrl + 'data/social.json')
            .then(response => {
                 if (!response.ok) {
                     throw new Error(`HTTP error! status: ${response.status}`);
                 }
                return response.json();
            })
            .then(data => {
                setSocialLinks(data || []); // Use empty array if response is empty
                setLoading(false);
            })
            .catch(err => {
                console.error("Failed to fetch social links:", err);
                setError("Could not load social media links.");
                setLoading(false);
            });
    }, [assetBaseUrl]);

     if (loading) {
        return React.createElement('div', { className: 'column is-full has-text-centered' }, // Wrap in column for centering
            React.createElement('p', { className: 'notification is-info is-light' }, 'Loading social links...')
        );
    }

    if (error) {
         return React.createElement('div', { className: 'column is-full has-text-centered' }, // Wrap in column for centering
             React.createElement('p', { className: 'notification is-warning' }, error)
         );
    }

     if (socialLinks.length === 0) {
         return React.createElement('div', { className: 'column is-full has-text-centered' }, // Wrap in column for centering
             React.createElement('p', { className: 'notification is-info' }, 'No social media links available.')
         );
     }

    // The parent div (#social-links-root) already has 'buttons is-centered are-large'
    // We just render the anchor tags directly
    return React.createElement(React.Fragment, null,
        socialLinks.map((platform, index) =>
            platform.url && platform.fa_class && platform.name && React.createElement('a', {
                key: index,
                href: platform.url,
                target: '_blank',
                rel: 'noopener noreferrer',
                className: 'button is-ghost social-icon-link', // Reuse existing class
                title: platform.name
            },
                 React.createElement('span', { className: 'icon is-large' },
                    React.createElement('i', { className: platform.fa_class }) // Use FA class
                 )
            )
        )
    );
}