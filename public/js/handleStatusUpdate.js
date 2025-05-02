// public/js/handleStatusUpdate.js
function handleStatusUpdate(event, postId, newStatus) {
    // 확인 대화상자 표시
    if(!confirm('Are you sure to change status?')) {
        return false;
    }
    
    // 폼 제출 방지
    event.preventDefault();
    
    // 폼 데이터 가져오기
    const form = event.target;
    const formData = new FormData(form);
    
    // AJAX 요청 보내기
    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            // 기존 알림 스타일로 메시지 표시
            const alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert-success';
            alertDiv.innerHTML = `
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                ${data.message}
            `;
            
            // 알림 표시 위치 (페이지 상단)
            const pageContent = document.querySelector('.page-content');
            pageContent.insertBefore(alertDiv, pageContent.firstChild);
            
            // 상태 셀 업데이트
            updateStatusCell(postId, newStatus);
            
            // 알림 자동 닫기 (선택 사항)
            setTimeout(() => {
                alertDiv.remove();
            }, 5000);
        } else {
            // 오류 메시지
            const alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert-danger';
            alertDiv.innerHTML = `
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                ${data.message || 'An error occurred'}
            `;
            
            const pageContent = document.querySelector('.page-content');
            pageContent.insertBefore(alertDiv, pageContent.firstChild);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        
        // 오류 알림
        const alertDiv = document.createElement('div');
        alertDiv.className = 'alert alert-danger';
        alertDiv.innerHTML = `
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            An error occurred. Please try again.
        `;
        
        const pageContent = document.querySelector('.page-content');
        pageContent.insertBefore(alertDiv, pageContent.firstChild);
    });
    
    return false;
}

function updateStatusCell(postId, currentStatus) {
    const statusCell = document.getElementById('status-cell-' + postId);
    
    if(currentStatus === 'active') {
        statusCell.innerHTML = `
            <form id="reject-form-${postId}" action="/admin/posts/${postId}/status" method="POST" 
                onsubmit="return handleStatusUpdate(event, ${postId}, 'reject')">
                <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                <input type="hidden" name="_method" value="PATCH">
                <input type="hidden" name="post_status" value="reject">
                <button type="submit" class="btn btn-outline-danger">Reject</button>
            </form>
        `;
    } else if(currentStatus === 'reject') {
        statusCell.innerHTML = `
            <form id="accept-form-${postId}" action="/admin/posts/${postId}/status" method="POST"
                onsubmit="return handleStatusUpdate(event, ${postId}, 'active')">
                <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                <input type="hidden" name="_method" value="PATCH">
                <input type="hidden" name="post_status" value="active">
                <button type="submit" class="btn btn-outline-secondary">Accept</button>
            </form>
        `;
    }
}

// 알림 닫기 버튼 처리
document.addEventListener('click', function(e) {
    if(e.target.matches('.alert .close')) {
        e.target.parentElement.remove();
    }
});