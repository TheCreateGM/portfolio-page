// Requires React and ReactDOM CDNs loaded BEFORE this script

// Simple React component to fetch and display projects
function ProjectsList({ assetBaseUrl }) {
    const [projectsData, setProjectsData] = React.useState(null);
    const [loading, setLoading] = React.useState(true);
    const [error, setError] = React.useState(null);

    React.useEffect(() => {
        fetch(assetBaseUrl + 'data/projects.json')
            .then(response => {
                 if (!response.ok) {
                     throw new Error(`HTTP error! status: ${response.status}`);
                 }
                return response.json();
            })
            .then(data => {
                setProjectsData(data || {}); // Use empty object if response is empty
                setLoading(false);
            })
            .catch(err => {
                console.error("Failed to fetch projects data:", err);
                setError("Could not load projects information.");
                setLoading(false);
            });
    }, [assetBaseUrl]);

     if (loading) {
        return React.createElement('div', { className: 'columns is-multiline' }, // Wrap loading state in columns
             React.createElement('div', { className: 'column is-full has-text-centered' },
                 React.createElement('p', { className: 'notification is-info is-light' }, 'Loading projects...')
             )
        );
    }

    if (error) {
         return React.createElement('div', { className: 'columns is-multiline' }, // Wrap error state in columns
             React.createElement('div', { className: 'column is-full has-text-centered' },
                 React.createElement('p', { className: 'notification is-warning' }, error)
             )
         );
    }

    if (!projectsData || Object.keys(projectsData).length === 0) {
         return React.createElement('div', { className: 'columns is-multiline' }, // Wrap empty state in columns
             React.createElement('div', { className: 'column is-full has-text-centered' },
                 React.createElement('p', { className: 'notification is-info' }, 'No projects information available.')
             )
         );
    }

     const categories = Object.keys(projectsData);

    return React.createElement(React.Fragment, null,
        categories.map((category, catIndex) =>
             projectsData[category].length > 0 && React.createElement('div', { key: category, className: 'mb-6' },
                React.createElement('h2', { className: 'title is-3 is-capitalized' }, category.replace('_', ' ')),
                React.createElement('div', { className: 'columns is-multiline' }, // Columns container for projects in this category
                    projectsData[category].map((project, projIndex) => {
                        const hasLiveLink = !!project.live_link;
                        const hasRepoLink = !!project.repo_link;
                        const linkTarget = hasLiveLink ? project.live_link : (hasRepoLink ? project.repo_link : null);
                         const hasImage = !!project.image;

                        return React.createElement('div', { key: projIndex, className: 'column is-one-third-desktop is-half-tablet project-card' }, // Each project is a column
                            React.createElement('div', { className: 'card', style: { height: '100%', display: 'flex', flexDirection: 'column' } },
                                // Image
                                hasImage ?
                                React.createElement('div', { className: 'card-image' },
                                    React.createElement('figure', { className: 'image is-16by9' },
                                        linkTarget ?
                                        React.createElement('a', { href: linkTarget, target: '_blank' },
                                             React.createElement('img', { src: assetBaseUrl + project.image, alt: project.title })
                                        ) :
                                        React.createElement('img', { src: assetBaseUrl + project.image, alt: project.title })
                                    )
                                ) :
                                React.createElement('div', { className: 'card-image' }, // Placeholder if no image
                                    React.createElement('figure', { className: 'image is-16by9' },
                                         React.createElement('img', { src: 'https://via.placeholder.com/640x360.png?text=No+Image', alt: 'No image available' })
                                    )
                                ),
                                // Content
                                React.createElement('div', { className: 'card-content', style: { flexGrow: 1 } },
                                    React.createElement('p', { className: 'title is-5' }, project.title),
                                    project.logos && project.logos.length > 0 && React.createElement('div', { className: 'tech-logos mb-2' },
                                        project.logos.map((logo, logoIndex) =>
                                            logo && React.createElement('img', {
                                                key: logoIndex,
                                                src: assetBaseUrl + logo,
                                                alt: 'Tech logo',
                                                style: { height: '24px', width: 'auto', marginRight: '5px', display: 'inline-block', verticalAlign: 'middle' }
                                            })
                                        )
                                    )
                                ),
                                // Footer links
                                React.createElement('footer', { className: 'card-footer' },
                                    hasLiveLink && React.createElement('a', { href: project.live_link, className: 'card-footer-item', target: '_blank' },
                                        React.createElement('span', { className: 'icon is-small' }, React.createElement('i', { className: 'fas fa-external-link-alt' })),
                                        ' View Live'
                                    ),
                                    hasRepoLink && React.createElement('a', { href: project.repo_link, className: 'card-footer-item', target: '_blank' },
                                        React.createElement('span', { className: 'icon is-small' }, React.createElement('i', { className: 'fab fa-github' })),
                                        ' View Code'
                                    ),
                                    !hasLiveLink && !hasRepoLink && React.createElement('span', { className: 'card-footer-item has-text-grey-light' }, 'No Links')
                                )
                            )
                        );
                    })
                ),
                 // Add HR after each category except the last one
                 catIndex < categories.length - 1 && categories[catIndex + 1] && projectsData[categories[catIndex + 1]].length > 0 && React.createElement('hr', null)
             )
        )
    );
}