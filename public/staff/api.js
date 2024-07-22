function openURL(baseUrl, queryParams) {
    const url = new URL(baseUrl);
    for (const key in queryParams) {
        url.searchParams.append(key, queryParams[key]);
    }
    window.open(url, "_blank");
}