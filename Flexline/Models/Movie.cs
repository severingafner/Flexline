using System.Web.Mvc;

namespace Flexline.Models
{
    public partial class Movie
    {
        public int Id { get; set; }
        [AllowHtml]
        public string Name { get; set; }
    }
}