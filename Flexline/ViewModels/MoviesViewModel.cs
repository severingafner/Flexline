using Flexline.Models;
using System.Collections.Generic;

namespace Flexline.ViewModels
{
    public class MoviesViewModel
    {
        public string SearchString { get; set; }
        public IEnumerable<Movie> Movies { get; set; }
    }
}
