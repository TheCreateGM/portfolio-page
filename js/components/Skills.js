// Requires React and ReactDOM CDNs loaded BEFORE this script

// Simple React component to fetch and display skills
function Skills({ assetBaseUrl }) {
    const [skills, setSkills] = React.useState([]);
    const [loading, setLoading] = React.useState(true);
    const [error, setError] = React.useState(null);

    React.useEffect(() => {
        fetch(assetBaseUrl + 'data/info.json')
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                setSkills(data.skills || []); // Use empty array if 'skills' key doesn't exist
                setLoading(false);
            })
            .catch(err => {
                console.error("Failed to fetch skills:", err);
                setError("Could not load skill information.");
                setLoading(false);
            });
    }, [assetBaseUrl]); // Dependency array ensures effect runs when assetBaseUrl changes (unlikely in this setup, but good practice)

    if (loading) {
        // Render loading state within a column
        return React.createElement('div', { className: 'columns is-multiline is-centered' },
            React.createElement('div', { className: 'column is-full has-text-centered' },
                React.createElement('p', { className: 'notification is-info is-light' }, 'Loading skills...')
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

    if (skills.length === 0) {
        // Render empty state within a column
        return React.createElement('div', { className: 'columns is-multiline is-centered' },
             React.createElement('div', { className: 'column is-full has-text-centered' },
                 React.createElement('p', { className: 'notification is-info' }, 'No skills information available.')
             )
        );
    }

    // Render the columns container and then map over skills, wrapping each in a column
    return React.createElement('div', { className: 'columns is-multiline is-centered' }, // This is the container
        skills.map((skill, index) =>
            React.createElement('div', { key: index, className: 'column is-half-tablet is-one-third-desktop' }, // Each skill is a column
                React.createElement('div', { className: 'card' },
                    skill.image && React.createElement('div', { className: 'card-image' },
                         // Using figure with image inside for consistent Bulma styling
                        React.createElement('figure', { className: 'image is-4by3' },
                            React.createElement('img', {
                                src: assetBaseUrl + skill.image,
                                alt: 'Skill image',
                                className: 'info-skill-image'
                            })
                        )
                    ),
                    React.createElement('div', { className: 'card-content' },
                        React.createElement('p', null, skill.description)
                    )
                )
            )
        )
    );
}