import Search from "./components/Search";
import AuthorCount from "./components/AuthorCount";
import notFound from "./components/404";

export default {
    mode: 'history',
    routes: [
        {
            path: '*',
            component: notFound
        },
        {
            path: '/',
            component: Search
        },
        {
            path: '/authorcount',
            component: AuthorCount
        },
    ]
}
