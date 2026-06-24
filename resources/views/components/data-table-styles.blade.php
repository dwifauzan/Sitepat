@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<style>
    /* Modern Table Container */
    .dataTables_wrapper {
        background: #ffffff;
        border-radius: 1rem;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        overflow: hidden;
        margin-bottom: 2rem;
    }
    
    /* Enhanced Search Input */
    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 1.5rem;
        padding: 1.5rem 1.5rem 0;
    }
    
    .dataTables_wrapper .dataTables_filter input {
        border: 2px solid #e2e8f0;
        border-radius: 0.75rem;
        padding: 0.875rem 1.25rem;
        font-size: 0.925rem;
        font-weight: 500;
        outline: none;
        transition: all 0.2s ease;
        margin-left: 0.75rem;
        background: #f8fafc;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        min-width: 320px;
    }
    
    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: #3b82f6;
        background: #ffffff;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.12), 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        transform: translateY(-1px);
    }
    
    .dataTables_wrapper .dataTables_filter input::placeholder {
        color: #94a3b8;
        font-weight: 400;
    }
    
    /* Enhanced Length Select */
    .dataTables_wrapper .dataTables_length {
        padding: 1.5rem 1.5rem 0;
        margin-bottom: 1rem;
    }
    
    .dataTables_wrapper .dataTables_length select {
        border: 2px solid #e2e8f0;
        border-radius: 0.75rem;
        padding: 0.625rem 1rem;
        font-size: 0.875rem;
        font-weight: 500;
        outline: none;
        margin: 0 0.75rem;
        background: #f8fafc;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        transition: all 0.2s ease;
        min-width: 80px;
    }
    
    .dataTables_wrapper .dataTables_filter input:focus,
    .dataTables_wrapper .dataTables_length select:focus {
        border-color: #3b82f6;
        background: #ffffff;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.12), 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    
    /* Modern Table Styling */
    table.dataTable {
        margin: 0 !important;
        border-collapse: separate;
        border-spacing: 0;
    }
    
    table.dataTable thead th {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-bottom: 2px solid #e2e8f0;
        padding: 1.25rem 1.5rem;
        font-weight: 700;
        font-size: 0.8rem;
        letter-spacing: 0.05em;
        color: #475569;
        text-transform: uppercase;
        position: relative;
    }
    
    table.dataTable thead th:first-child {
        border-top-left-radius: 0;
    }
    
    table.dataTable thead th:last-child {
        border-top-right-radius: 0;
    }
    
    table.dataTable tbody td {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
        font-size: 0.925rem;
        line-height: 1.5;
    }
    
    table.dataTable tbody tr {
        background-color: #ffffff;
        transition: all 0.2s ease;
    }
    
    table.dataTable tbody tr:hover {
        background-color: #f8fafc;
        box-shadow: inset 0 0 0 1px #e2e8f0;
        transform: translateY(-1px);
    }
    
    table.dataTable tbody tr:last-child td {
        border-bottom: none;
    }
    
    /* Enhanced Pagination */
    .dataTables_wrapper .dataTables_paginate {
        padding: 1.5rem;
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 0.75rem;
        padding: 0.625rem 1rem;
        margin: 0 0.25rem;
        font-size: 0.875rem;
        font-weight: 600;
        border: 2px solid #e2e8f0;
        background: #ffffff;
        color: #64748b !important;
        transition: all 0.2s ease;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        min-width: 40px;
        text-align: center;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #3b82f6 !important;
        border-color: #3b82f6 !important;
        color: #ffffff !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%) !important;
        border-color: #3b82f6 !important;
        color: #ffffff !important;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%) !important;
        border-color: #2563eb !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(37, 99, 235, 0.5);
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
        opacity: 0.4;
        cursor: not-allowed;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
        background: #ffffff !important;
        border-color: #e2e8f0 !important;
        color: #64748b !important;
        transform: none;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
    }
    
    /* Enhanced Info Display */
    .dataTables_wrapper .dataTables_info {
        font-size: 0.875rem;
        color: #64748b;
        font-weight: 500;
        padding: 1.5rem 1.5rem 0;
        background: #f8fafc;
        margin: 0;
    }
    
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        font-size: 0.925rem;
        color: #475569;
        font-weight: 600;
    }
    
    /* Remove default DataTable borders */
    table.dataTable.no-footer { 
        border-bottom: none; 
    }
    
    /* Responsive Enhancements */
    @media (max-width: 768px) {
        .dataTables_wrapper .dataTables_filter input {
            min-width: 240px;
            margin-left: 0;
            margin-top: 0.5rem;
        }
        
        table.dataTable thead th,
        table.dataTable tbody td {
            padding: 1rem;
        }
        
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            padding-left: 1rem;
            padding-right: 1rem;
        }
    }
    
    /* Loading State */
    .dataTables_processing {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%) !important;
        border: 2px solid #e2e8f0 !important;
        border-radius: 0.75rem !important;
        color: #475569 !important;
        font-weight: 600 !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
    }
</style>
@endpush
@push('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
@endpush