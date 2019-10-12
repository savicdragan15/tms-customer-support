import axios from 'axios'

export const issueService = {
    index,
    destroy
}

function index() {
    return axios.get('admin/issues')
}

function destroy(id) {
    return axios.delete(`admin/issues/${id}`, id)
}
