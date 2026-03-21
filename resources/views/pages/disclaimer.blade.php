@extends('layouts.app')

@section('title', 'Legal Disclaimer')

@section('content')
<section class="bg-gray-50 py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-lg p-8 md:p-12">
            <h1 class="text-4xl font-serif font-bold text-gray-900 mb-8">Legal Disclaimer</h1>
            
            <div class="prose prose-lg max-w-none text-gray-600">
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-8">
                    <p class="font-semibold text-yellow-800">Important Notice</p>
                    <p class="text-yellow-700">The information provided on this website does not constitute legal advice.</p>
                </div>
                
                <h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">No Attorney-Client Relationship</h2>
                <p class="mb-4">Visiting this website, using the contact form, or downloading legal forms does not create an attorney-client relationship between you and Alebe Advocate. An attorney-client relationship is only established after a formal written engagement agreement is signed by both parties.</p>
                
                <h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">Information Accuracy</h2>
                <p class="mb-4">While we strive to keep the information on this website accurate and up-to-date, we make no representations or warranties of any kind, express or implied, about the completeness, accuracy, reliability, suitability, or availability of the website or the information contained on it.</p>
                
                <h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">Legal Forms</h2>
                <p class="mb-4">The legal forms available for purchase are templates and may not be suitable for your specific situation. We strongly recommend consulting with a qualified attorney before using any legal document, especially for complex matters.</p>

                <h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">Third-Party Links</h2>
                <p class="mb-4">This website may contain links to third-party websites. We have no control over the nature, content, and availability of those sites. The inclusion of any links does not necessarily imply a recommendation or endorse the views expressed within them.</p>
                
                <h2 class="text-2xl font-bold text-gray-900 mt-8 mb-4">Governing Law</h2>
                <p class="mb-4">This legal disclaimer and your use of this website are governed by the laws of the Federal Democratic Republic of Ethiopia. Any disputes arising from your use of this website shall be subject to the exclusive jurisdiction of the courts of Ethiopia.</p>
                
                <p class="mt-8 text-sm text-gray-500">Last updated: {{ date('F Y') }}</p>
            </div>
        </div>
    </div>
</section>
@endsection
