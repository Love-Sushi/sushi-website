module.exports = {
  branches: 'main',
  repositoryUrl: 'https://github.com/Love-Sushi/sushi-website',
  plugins: [
    '@semantic-release/commit-analyzer',
    '@semantic-release/release-notes-generator',
    '@semantic-release/github',
  ],
};
